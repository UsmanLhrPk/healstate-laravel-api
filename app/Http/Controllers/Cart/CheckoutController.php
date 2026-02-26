<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CheckoutRequest;
use App\Models\Address;
use App\Models\ServiceBooking;
use App\Notifications\OrderConfirmationNotification;
use App\Notifications\ServiceBookingConfirmationNotification;
use App\Services\AddressService;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService    $cartService,
        protected OrderService   $orderService,
        protected PaymentService $paymentService,
        protected AddressService $addressService
    ) {}

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function getSessionId(Request $request): ?string
    {
        if (auth('sanctum')->check()) {
            return null;
        }

        $sessionId = $request->header('X-Cart-Session-ID')
            ?? $request->cookie('cart_session_id');

        return $sessionId ?? Str::uuid()->toString();
    }

    // ── Create payment intent ─────────────────────────────────────────────────

    public function createPaymentIntent(Request $request): JsonResponse
    {
        $userId    = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

        if (empty($totals['currencies']) && ! isset($totals['currency'])) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        // ── Single currency ───────────────────────────────────────────────
        if (! $totals['has_multiple_currencies']) {
            if ($totals['total'] < 0.50) {
                return response()->json([
                    'message'       => "Cart total must be at least {$totals['currency_symbol']}0.50 {$totals['currency']}",
                    'current_total' => $totals['total'],
                ], 422);
            }

            $pi = $this->paymentService->createPaymentIntent(
                $totals['total'],
                $totals['currency'],
                ['user_id' => $userId, 'session_id' => $sessionId]
            );

            return $this->jsonWithSessionCookie([
                'data' => [
                    'client_secret'           => $pi['client_secret'],
                    'payment_intent_id'       => $pi['payment_intent_id'],
                    'amount'                  => $totals['total'],
                    'currency'                => $totals['currency'],
                    'currency_symbol'         => $totals['currency_symbol'],
                    'has_multiple_currencies' => false,
                ],
            ], $request, $sessionId);
        }

        // ── Multiple currencies ────────────────────────────────────────────
        $paymentIntents = [];
        foreach ($totals['currencies'] as $currencyData) {
            if ($currencyData['total'] < 0.50) {
                return response()->json([
                    'message'       => "Cart total for {$currencyData['currency']} must be at least {$currencyData['currency_symbol']}0.50",
                    'current_total' => $currencyData['total'],
                    'currency'      => $currencyData['currency'],
                ], 422);
            }

            $pi = $this->paymentService->createPaymentIntent(
                $currencyData['total'],
                $currencyData['currency'],
                ['user_id' => $userId, 'session_id' => $sessionId]
            );

            $paymentIntents[] = array_merge(
                collect($currencyData)->except('items')->toArray(),
                [
                    'client_secret'     => $pi['client_secret'],
                    'payment_intent_id' => $pi['payment_intent_id'],
                ]
            );
        }

        return $this->jsonWithSessionCookie([
            'data' => [
                'payment_intents'         => $paymentIntents,
                'has_multiple_currencies' => true,
            ],
        ], $request, $sessionId);
    }

    // ── Process checkout ──────────────────────────────────────────────────────

    public function processCheckout(CheckoutRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $userId    = auth('sanctum')->id();
            $sessionId = $this->getSessionId($request);

            // Resolve address
            $address = $userId
                ? Address::findOrFail($request->address_id)
                : Address::create(['user_id' => null, ...$request->address]);

            $cartGrouped = $this->cartService->getCartGroupedByCurrency($userId, $sessionId);

            if ($cartGrouped->isEmpty()) {
                return response()->json(['message' => 'Cart is empty'], 422);
            }

            $orders = [];

            // ── Determine payment data ─────────────────────────────────────
            $paymentIntents = $request->has('payment_method_id')
                ? [[
                    'currency'          => $cartGrouped->keys()->first(),
                    'payment_method_id' => $request->payment_method_id,
                    'payment_intent_id' => null,
                  ]]
                : ($request->payment_intents ?? []);

            if (empty($paymentIntents)) {
                return response()->json(['message' => 'Payment information is required'], 422);
            }

            // ── One order per currency ─────────────────────────────────────
            foreach ($paymentIntents as $paymentData) {
                $currency        = $paymentData['currency'];
                $paymentIntentId = $paymentData['payment_intent_id'] ?? null;
                $paymentMethodId = $paymentData['payment_method_id'] ?? null;

                if (! isset($cartGrouped[$currency])) {
                    continue;
                }

                $currencyData = $cartGrouped[$currency];

                // createOrderForCurrency handles ALL booking creation internally
                // including double-booking guards — do NOT create bookings again here
                $order = $this->orderService->createOrderForCurrency(
                    $userId,
                    $sessionId,
                    $currency,
                    [
                        'payment_intent_id' => $paymentIntentId ?? $paymentMethodId,
                        'order_notes'       => $request->order_notes,
                        'currency'          => $currency,
                        'currency_symbol'   => $currencyData['currency_symbol'],
                    ],
                    $address
                );

                $order = $this->orderService->markOrderAsPaid(
                    $order,
                    $paymentIntentId ?? $paymentMethodId
                );

                $orders[] = $order;
            }

            // Clear cart
            $this->cartService->clearCart($userId, $sessionId);

            // Notifications
            if ($userId) {
                $user = auth('sanctum')->user();

                foreach ($orders as $order) {
                    $user->notify(new OrderConfirmationNotification($order));
                }
            }

            return $this->jsonWithSessionCookie([
                'message' => count($orders) > 1 ? 'Orders placed successfully' : 'Order placed successfully',
                'data'    => [
                    'orders'      => $orders,
                    'total_orders' => count($orders),
                ],
            ], $request, $sessionId, 201);
        });
    }

    // ── Verify payment ────────────────────────────────────────────────────────

    public function verifyPayment(Request $request): JsonResponse
    {
        $request->validate(['payment_intent_id' => 'required|string']);

        $payment = $this->paymentService->confirmPayment($request->payment_intent_id);

        return response()->json(['data' => $payment]);
    }

    // ── Utility ───────────────────────────────────────────────────────────────

    private function jsonWithSessionCookie(
        array   $payload,
        Request $request,
        ?string $sessionId,
        int     $status = 200
    ): JsonResponse {
        $response = response()->json($payload, $status);

        if (! auth('sanctum')->check() && $sessionId) {
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
        }

        return $response;
    }
}
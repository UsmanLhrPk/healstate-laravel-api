<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CheckoutRequest;
use App\Models\Address;
use App\Models\PractitionerOfferingBooking;
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

            $orders              = [];
            $allPractBookings    = [];
            $allServiceBookings  = [];

            // ── Determine payment data ─────────────────────────────────────
            $paymentIntents = $request->has('payment_method_id')
                // Legacy single-currency format
                ? [['currency' => $cartGrouped->keys()->first(), 'payment_method_id' => $request->payment_method_id]]
                : ($request->payment_intents ?? []);

            if (empty($paymentIntents)) {
                return response()->json(['message' => 'Payment information is required'], 422);
            }

            // ── One order per currency ─────────────────────────────────────
            foreach ($paymentIntents as $paymentData) {
                $currency        = $paymentData['currency'];
                $paymentMethodId = $paymentData['payment_method_id'];

                if (! isset($cartGrouped[$currency])) {
                    continue;
                }

                $currencyData = $cartGrouped[$currency];

                $order = $this->orderService->createOrderForCurrency(
                    $userId,
                    $sessionId,
                    $currency,
                    [
                        'payment_method_id' => $paymentMethodId,
                        'order_notes'       => $request->order_notes,
                        'currency'          => $currency,
                        'currency_symbol'   => $currencyData['currency_symbol'],
                    ],
                    $address
                );

                // ── Create bookings for items in this order ────────────────
                [$practBookings, $serviceBookings] = $this->createBookingsForOrder(
                    $order,
                    $currencyData['items'],
                    $userId,
                    $request->order_notes
                );

                $allPractBookings   = array_merge($allPractBookings,   $practBookings);
                $allServiceBookings = array_merge($allServiceBookings, $serviceBookings);

                $order = $this->orderService->markOrderAsPaid($order, $paymentMethodId);
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

                foreach ($allServiceBookings as $booking) {
                    $user->notify(new ServiceBookingConfirmationNotification($booking));
                }

                // Add healer booking notifications here if you create one later
            }

            return $this->jsonWithSessionCookie([
                'message' => count($orders) > 1 ? 'Orders placed successfully' : 'Order placed successfully',
                'data'    => [
                    'orders'                => $orders,
                    'practitioner_bookings' => $allPractBookings  ?: null,
                    'service_bookings'      => $allServiceBookings ?: null,
                    'total_orders'          => count($orders),
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

    // ── Private: booking creation ─────────────────────────────────────────────

    /**
     * Create PractitionerOfferingBookings and legacy ServiceBookings for
     * cart items that belong to the given order.
     *
     * Returns [practitionerBookings[], serviceBookings[]]
     */
    private function createBookingsForOrder($order, $cartItems, ?int $userId, ?string $orderNotes): array
    {
        $practBookings   = [];
        $serviceBookings = [];

        foreach ($cartItems as $item) {

            // ── Healer / practitioner offering slot ────────────────────────
            if ($item->isPractitionerBooking()) {
                $booking = PractitionerOfferingBooking::create([
                    'practitioner_offering_slot_id' => $item->practitioner_offering_slot_id,
                    'user_id'                       => $userId,
                    'booking_date'                  => $item->booking_date,
                    'start_time'                    => $item->start_time,
                    'end_time'                      => $item->end_time,
                    'status'                        => 'confirmed',
                ]);

                $practBookings[] = $booking;
                continue;
            }

            // ── Legacy vendor service slot ─────────────────────────────────
            if ($item->isServiceBooking()) {
                $booking = ServiceBooking::create([
                    'service_slot_id' => $item->service_slot_id,
                    'user_id'         => $userId,
                    'booking_date'    => $item->booking_date,
                    'start_time'      => $item->start_time,
                    'end_time'        => $item->end_time,
                    'status'          => 'confirmed',
                    'order_id'        => $order->id,
                    'total_price'     => ($item->serviceSlot?->price ?? 0) * $item->quantity,
                    'quantity'        => $item->quantity,
                    'notes'           => $orderNotes,
                ]);

                $serviceBookings[] = $booking;
            }
        }

        return [$practBookings, $serviceBookings];
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
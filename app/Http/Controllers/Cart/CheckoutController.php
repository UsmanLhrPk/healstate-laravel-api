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

/**
 * @group Checkout
 *
 * APIs for checkout process
 */
class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected OrderService $orderService,
        protected PaymentService $paymentService,
        protected AddressService $addressService
    ) {}

    /**
     * Get or generate session ID for guest users
     */
    private function getSessionId(Request $request): ?string
    {
        // For authenticated users, return null (will use user_id instead)
        if (auth('sanctum')->check()) {
            return null;
        }

        // For guests, get session ID from header or cookie
        $sessionId = $request->header('X-Cart-Session-ID') ?? $request->cookie('cart_session_id');

        // Generate new session ID if not exists
        if (! $sessionId) {
            $sessionId = Str::uuid()->toString();
        }

        return $sessionId;
    }

    /**
     * Create Payment Intent
     *
     * Create a Stripe payment intent for the cart total.
     *
     * @response {
     *   "data": {
     *     "client_secret": "pi_xxx_secret_xxx",
     *     "payment_intent_id": "pi_xxx",
     *     "amount": 107.17
     *   }
     * }
     */
    public function createPaymentIntent(Request $request): JsonResponse
    {
        $userId = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

        // Validate minimum amount
        if ($totals['total'] < 0.50) {
            return response()->json([
                'message' => "Cart total must be at least {$totals['currency_symbol']}0.50 {$totals['currency']}",
                'current_total' => $totals['total'],
            ], 422);
        }

        // Pass currency to payment service
        $paymentIntent = $this->paymentService->createPaymentIntent(
            $totals['total'],
            $totals['currency'], // Add currency parameter
            [
                'user_id' => $userId,
                'session_id' => $sessionId,
            ]
        );

        $response = response()->json([
            'data' => [
                'client_secret' => $paymentIntent['client_secret'],
                'payment_intent_id' => $paymentIntent['payment_intent_id'],
                'amount' => $totals['total'],
                'currency' => $totals['currency'],
                'currency_symbol' => $totals['currency_symbol'],
            ],
        ]);

        if (! auth('sanctum')->check() && $sessionId) {
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
        }

        return $response;
    }

    /**
     * Process Checkout
     *
     * Complete the checkout process and create an order.
     *
     * @bodyParam payment_method_id string required Stripe payment method ID. Example: pm_xxx
     * @bodyParam address_id integer required Address ID (for authenticated users). Example: 1
     * @bodyParam address object required Address object (for guest users).
     * @bodyParam order_notes string optional Order notes. Example: Please ring doorbell
     *
     * @response 201 {
     *   "message": "Order placed successfully",
     *   "data": {
     *     "order_number": "ORD-ABC123",
     *     "total": 107.17,
     *     "status": "paid"
     *   }
     * }
     */
    public function processCheckout(CheckoutRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $userId = auth('sanctum')->id();
            $sessionId = $this->getSessionId($request);

            // Get or create address
            if ($userId) {
                $address = Address::findOrFail($request->address_id);
            } else {
                $address = Address::create([
                    'user_id' => null,
                    ...$request->address,
                ]);
            }

            // Calculate totals with currency
            $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

            // Validate minimum amount
            if ($totals['total'] < 0.50) {
                return response()->json([
                    'message' => "Cart total must be at least {$totals['currency_symbol']}0.50 {$totals['currency']}",
                    'current_total' => $totals['total'],
                ], 422);
            }

            // Create order with currency
            $order = $this->orderService->createOrder(
                $userId,
                $sessionId,
                [
                    'payment_method_id' => $request->payment_method_id,
                    'order_notes' => $request->order_notes,
                    'currency' => $totals['currency'],
                    'currency_symbol' => $totals['currency_symbol'],
                ],
                $address
            );

            // Rest of the code remains the same...
            $cartItems = $this->cartService->getCart($userId, $sessionId);
            $serviceBookings = [];

            foreach ($cartItems as $item) {
                if ($item->service_slot_id) {
                    $serviceBooking = ServiceBooking::create([
                        'service_slot_id' => $item->service_slot_id,
                        'user_id' => $userId,
                        'booking_date' => $item->booking_date,
                        'start_time' => $item->start_time,
                        'end_time' => $item->end_time,
                        'status' => 'confirmed',
                        'order_id' => $order->id,
                        'total_price' => $item->price * $item->quantity,
                        'quantity' => $item->quantity,
                        'notes' => $request->order_notes,
                    ]);

                    if ($item->id) {
                        $item->update(['service_booking_id' => $serviceBooking->id]);
                    }

                    $serviceBookings[] = $serviceBooking;
                }
            }

            $order = $this->orderService->markOrderAsPaid(
                $order,
                $request->payment_method_id
            );

            $this->cartService->clearCart($userId, $sessionId);

            if ($userId) {
                $user = auth('sanctum')->user();
                $user->notify(new OrderConfirmationNotification($order));

                if (! empty($serviceBookings)) {
                    foreach ($serviceBookings as $booking) {
                        $user->notify(new ServiceBookingConfirmationNotification($booking));
                    }
                }
            }

            $response = response()->json([
                'message' => 'Order placed successfully',
                'data' => [
                    'order' => $order,
                    'service_bookings' => ! empty($serviceBookings) ? $serviceBookings : null,
                ],
            ], 201);

            if (! auth('sanctum')->check() && $sessionId) {
                $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
            }

            return $response;
        });
    }

    /**
     * Verify Payment
     *
     * Verify a payment intent status.
     *
     * @bodyParam payment_intent_id string required Payment intent ID. Example: pi_xxx
     *
     * @response {
     *   "data": {
     *     "status": "succeeded",
     *     "payment_intent_id": "pi_xxx",
     *     "amount": 107.17
     *   }
     * }
     */
    public function verifyPayment(Request $request): JsonResponse
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        $payment = $this->paymentService->confirmPayment(
            $request->payment_intent_id
        );

        return response()->json([
            'data' => $payment,
        ]);
    }
}

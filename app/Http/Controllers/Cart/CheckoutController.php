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
     * Create Payment Intent (supports multi-currency)
     *
     * Create Stripe payment intent(s) for the cart. If cart has multiple currencies,
     * creates separate payment intents for each currency.
     *
     * @bodyParam currency string optional Specific currency to create payment intent for (when cart has multiple currencies)
     *
     * @response {
     *   "data": {
     *     "payment_intents": [
     *       {
     *         "currency": "USD",
     *         "currency_symbol": "$",
     *         "client_secret": "pi_xxx_secret_xxx",
     *         "payment_intent_id": "pi_xxx",
     *         "amount": 107.17
     *       }
     *     ],
     *     "has_multiple_currencies": false
     *   }
     * }
     */
    public function createPaymentIntent(Request $request): JsonResponse
    {
        $userId = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        // Get cart totals (handles multi-currency)
        $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

        // Handle empty cart
        if (empty($totals['currencies']) && !isset($totals['currency'])) {
            return response()->json([
                'message' => 'Cart is empty',
            ], 422);
        }

        // Single currency cart (backward compatible)
        if (!$totals['has_multiple_currencies']) {
            // Validate minimum amount
            if ($totals['total'] < 0.50) {
                return response()->json([
                    'message' => "Cart total must be at least {$totals['currency_symbol']}0.50 {$totals['currency']}",
                    'current_total' => $totals['total'],
                ], 422);
            }

            $paymentIntent = $this->paymentService->createPaymentIntent(
                $totals['total'],
                $totals['currency'],
                [
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'currency' => $totals['currency'],
                ]
            );

            $response = response()->json([
                'data' => [
                    'client_secret' => $paymentIntent['client_secret'],
                    'payment_intent_id' => $paymentIntent['payment_intent_id'],
                    'amount' => $totals['total'],
                    'currency' => $totals['currency'],
                    'currency_symbol' => $totals['currency_symbol'],
                    'has_multiple_currencies' => false,
                ],
            ]);

            if (!auth('sanctum')->check() && $sessionId) {
                $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
            }

            return $response;
        }

        // Multi-currency cart - create payment intents for each currency
        $paymentIntents = [];
        
        foreach ($totals['currencies'] as $currencyData) {
            // Validate minimum amount for this currency
            if ($currencyData['total'] < 0.50) {
                return response()->json([
                    'message' => "Cart total for {$currencyData['currency']} must be at least {$currencyData['currency_symbol']}0.50",
                    'current_total' => $currencyData['total'],
                    'currency' => $currencyData['currency'],
                ], 422);
            }

            $paymentIntent = $this->paymentService->createPaymentIntent(
                $currencyData['total'],
                $currencyData['currency'],
                [
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'currency' => $currencyData['currency'],
                ]
            );

            $paymentIntents[] = [
                'currency' => $currencyData['currency'],
                'currency_symbol' => $currencyData['currency_symbol'],
                'client_secret' => $paymentIntent['client_secret'],
                'payment_intent_id' => $paymentIntent['payment_intent_id'],
                'amount' => $currencyData['total'],
                'subtotal' => $currencyData['subtotal'],
                'shipping' => $currencyData['shipping'],
                'commission_fee' => $currencyData['commission_fee'],
            ];
        }

        $response = response()->json([
            'data' => [
                'payment_intents' => $paymentIntents,
                'has_multiple_currencies' => true,
            ],
        ]);

        if (!auth('sanctum')->check() && $sessionId) {
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
        }

        return $response;
    }

    /**
     * Process Checkout (supports multi-currency)
     *
     * Complete the checkout process and create order(s). If cart has multiple currencies,
     * creates separate orders for each currency.
     *
     * @bodyParam payment_intents array required Array of payment method IDs with their currencies
     * @bodyParam payment_intents.*.payment_method_id string required Stripe payment method ID
     * @bodyParam payment_intents.*.currency string required Currency for this payment
     * @bodyParam address_id integer required Address ID (for authenticated users)
     * @bodyParam address object required Address object (for guest users)
     * @bodyParam order_notes string optional Order notes
     *
     * @response 201 {
     *   "message": "Order(s) placed successfully",
     *   "data": {
     *     "orders": [
     *       {
     *         "order_number": "ORD-ABC123",
     *         "total": 107.17,
     *         "currency": "USD",
     *         "status": "paid"
     *       }
     *     ]
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

            // Get cart grouped by currency
            $cartGrouped = $this->cartService->getCartGroupedByCurrency($userId, $sessionId);
            
            if ($cartGrouped->isEmpty()) {
                return response()->json([
                    'message' => 'Cart is empty',
                ], 422);
            }

            $orders = [];
            $allServiceBookings = [];

            // Handle backward compatibility - single payment_method_id
            if (isset($request->payment_method_id)) {
                // Single currency checkout (old format)
                if ($cartGrouped->count() > 1) {
                    return response()->json([
                        'message' => 'Cart contains multiple currencies. Please use the payment_intents array format.',
                    ], 422);
                }

                $currencyData = $cartGrouped->first();
                $currency = $currencyData['currency'];

                // Create single order
                $order = $this->orderService->createOrderForCurrency(
                    $userId,
                    $sessionId,
                    $currency,
                    [
                        'payment_method_id' => $request->payment_method_id,
                        'order_notes' => $request->order_notes,
                        'currency' => $currency,
                        'currency_symbol' => $currencyData['currency_symbol'],
                    ],
                    $address
                );

                // Handle service bookings for this order
                $serviceBookings = $this->createServiceBookingsForOrder($order, $currencyData['items'], $userId, $request->order_notes);
                $allServiceBookings = array_merge($allServiceBookings, $serviceBookings);

                // Mark order as paid
                $order = $this->orderService->markOrderAsPaid($order, $request->payment_method_id);
                $orders[] = $order;

            } else {
                // Multi-currency checkout (new format)
                $paymentIntents = $request->payment_intents ?? [];

                if (empty($paymentIntents)) {
                    return response()->json([
                        'message' => 'Payment information is required',
                    ], 422);
                }

                // Create an order for each currency
                foreach ($paymentIntents as $paymentData) {
                    $currency = $paymentData['currency'];
                    $paymentMethodId = $paymentData['payment_method_id'];

                    // Get cart items for this currency
                    if (!isset($cartGrouped[$currency])) {
                        continue;
                    }

                    $currencyData = $cartGrouped[$currency];

                    // Create order for this currency
                    $order = $this->orderService->createOrderForCurrency(
                        $userId,
                        $sessionId,
                        $currency,
                        [
                            'payment_method_id' => $paymentMethodId,
                            'order_notes' => $request->order_notes,
                            'currency' => $currency,
                            'currency_symbol' => $currencyData['currency_symbol'],
                        ],
                        $address
                    );

                    // Handle service bookings for this order
                    $serviceBookings = $this->createServiceBookingsForOrder($order, $currencyData['items'], $userId, $request->order_notes);
                    $allServiceBookings = array_merge($allServiceBookings, $serviceBookings);

                    // Mark order as paid
                    $order = $this->orderService->markOrderAsPaid($order, $paymentMethodId);
                    $orders[] = $order;
                }
            }

            // Clear the entire cart
            $this->cartService->clearCart($userId, $sessionId);

            // Send notifications
            if ($userId) {
                $user = auth('sanctum')->user();
                
                foreach ($orders as $order) {
                    $user->notify(new OrderConfirmationNotification($order));
                }

                if (!empty($allServiceBookings)) {
                    foreach ($allServiceBookings as $booking) {
                        $user->notify(new ServiceBookingConfirmationNotification($booking));
                    }
                }
            }

            $response = response()->json([
                'message' => count($orders) > 1 
                    ? 'Orders placed successfully' 
                    : 'Order placed successfully',
                'data' => [
                    'orders' => $orders,
                    'service_bookings' => !empty($allServiceBookings) ? $allServiceBookings : null,
                    'total_orders' => count($orders),
                ],
            ], 201);

            if (!auth('sanctum')->check() && $sessionId) {
                $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
            }

            return $response;
        });
    }

    /**
     * Create service bookings for an order
     */
    private function createServiceBookingsForOrder($order, $cartItems, $userId, $orderNotes): array
    {
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
                    'total_price' => $item->serviceSlot->price * $item->quantity,
                    'quantity' => $item->quantity,
                    'notes' => $orderNotes,
                ]);

                if ($item->id) {
                    $item->update(['service_booking_id' => $serviceBooking->id]);
                }

                $serviceBookings[] = $serviceBooking;
            }
        }

        return $serviceBookings;
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
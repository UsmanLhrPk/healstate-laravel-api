<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CheckoutRequest;
use App\Models\Address;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\AddressService;
use App\Notifications\OrderConfirmationNotification;
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
        if (auth()->check()) {
            return null;
        }
        
        // For guests, get session ID from header or cookie
        $sessionId = $request->header('X-Cart-Session-ID') ?? $request->cookie('cart_session_id');
        
        // Generate new session ID if not exists
        if (!$sessionId) {
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
        $userId = auth()->id();
        $sessionId = $this->getSessionId($request);

        $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

        if ($totals['total'] <= 0) {
            return response()->json([
                'message' => 'Cart is empty',
            ], 422);
        }

        $paymentIntent = $this->paymentService->createPaymentIntent(
            $totals['total'],
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
            ],
        ]);

        // Set cookie for guest users
        if (!auth()->check() && $sessionId) {
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30); // 30 days
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
            $userId = auth()->id();
            $sessionId = $this->getSessionId($request);

            // Get or create address
            if ($userId) {
                $address = Address::findOrFail($request->address_id);
            } else {
                // Create temporary address for guest
                $address = Address::create([
                    'user_id' => null,
                    ...$request->address,
                ]);
            }

            // Calculate totals
            $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

            // Create payment intent
            $paymentIntent = $this->paymentService->createPaymentIntent(
                $totals['total'],
                [
                    'user_id' => $userId,
                    'order_notes' => $request->order_notes,
                ]
            );

            // Create order
            $order = $this->orderService->createOrder(
                $userId,
                $sessionId,
                [
                    'payment_intent_id' => $paymentIntent['payment_intent_id'],
                    'order_notes' => $request->order_notes,
                ],
                $address
            );

            // Mark order as paid (in real scenario, this happens via webhook)
            $order = $this->orderService->markOrderAsPaid(
                $order,
                $paymentIntent['payment_intent_id']
            );

            // Clear cart
            $this->cartService->clearCart($userId, $sessionId);

            // Send confirmation email
            if ($userId) {
                auth()->user()->notify(new OrderConfirmationNotification($order));
            }

            $response = response()->json([
                'message' => 'Order placed successfully',
                'data' => $order,
            ], 201);

            // Set cookie for guest users
            if (!auth()->check() && $sessionId) {
                $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30); // 30 days
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
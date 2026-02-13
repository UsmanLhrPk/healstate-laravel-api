<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Order Management
 *
 * APIs for managing orders
 */
class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    /**
     * Get User Orders
     *
     * Retrieve all orders for the authenticated user.
     *
     * @authenticated
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "order_number": "ORD-ABC123",
     *       "total": 107.17,
     *       "status": "paid",
     *       "cancellation_type": null,
     *       "can_cancel_immediately": true,
     *       "time_remaining_minutes": 25,
     *       "created_at": "2024-01-01T00:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function index(): JsonResponse
    {
        $orders = $this->orderService->getUserOrders(auth()->id());

        // Add cancellation info to each order
        $orders->getCollection()->transform(function ($order) {
            $order->can_cancel_immediately = $order->canCancelImmediately();
            $order->can_request_cancellation = $order->canRequestCancellation();
            $order->time_remaining_minutes = $order->getCancellationTimeRemaining();

            return $order;
        });

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * Get Order Details
     *
     * Retrieve detailed information about a specific order.
     *
     * @authenticated
     *
     * @urlParam order integer required The order ID. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-ABC123",
     *     "total": 107.17,
     *     "status": "paid",
     *     "cancellation_type": null,
     *     "cancellation_requested_at": null,
     *     "cancellation_reason": null,
     *     "items": [],
     *     "address": {}
     *   },
     *   "cancellation_info": {
     *     "can_cancel_immediately": true,
     *     "can_request_cancellation": true,
     *     "time_remaining_minutes": 25,
     *     "cancellation_deadline": "2024-01-01T00:30:00.000000Z"
     *   }
     * }
     */
    public function show(Order $order): JsonResponse
    {
        $this->authorize('view', $order);

        $order = $this->orderService->getOrderDetails($order);

        // Calculate cancellation deadline
        $cancellationDeadline = $order->created_at->copy()->addMinutes(30);

        // Add cancellation info to response
        $cancellationInfo = [
            'can_cancel_immediately' => $order->canCancelImmediately(),
            'can_request_cancellation' => $order->canRequestCancellation(),
            'time_remaining_minutes' => $order->getCancellationTimeRemaining(),
            'cancellation_deadline' => $cancellationDeadline->toIso8601String(),
        ];

        return response()->json([
            'data' => $order,
            'cancellation_info' => $cancellationInfo,
        ]);
    }

    /**
     * Cancel Order
     *
     * Cancel an order immediately (within 30 minutes) or request cancellation (after 30 minutes).
     *
     * - **Within 30 minutes**: Order is cancelled immediately
     * - **After 30 minutes**: Cancellation request is sent to vendor for approval
     *
     * @authenticated
     *
     * @urlParam order integer required The order ID. Example: 1
     *
     * @bodyParam reason string optional Reason for cancellation. Example: Changed my mind
     *
     * @response scenario="Immediate Cancellation" {
     *   "message": "Order cancelled successfully",
     *   "cancellation_type": "immediate",
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-ABC123",
     *     "status": "cancelled",
     *     "cancellation_type": "immediate",
     *     "cancelled_by": "user",
     *     "cancellation_reason": "Changed my mind",
     *     "cancellation_requested_at": "2024-01-01T00:15:00.000000Z"
     *   }
     * }
     * @response scenario="Cancellation Request" {
     *   "message": "Cancellation request sent to vendor. You will be notified once the vendor responds.",
     *   "cancellation_type": "requested",
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-ABC123",
     *     "status": "cancellation_requested",
     *     "cancellation_type": "requested",
     *     "cancellation_reason": "Changed my mind",
     *     "cancellation_requested_at": "2024-01-01T01:00:00.000000Z"
     *   }
     * }
     * @response status=400 scenario="Cannot Cancel" {
     *   "message": "Order cannot be cancelled at this time"
     * }
     */
    public function cancel(Order $order, Request $request): JsonResponse
    {
        $this->authorize('cancel', $order);

        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        try {
            $order = $this->orderService->cancelOrder($order, $validated['reason'] ?? null);

            // Determine response message based on cancellation type
            $message = match ($order->cancellation_type) {
                'immediate' => 'Order cancelled successfully',
                'requested' => 'Cancellation request sent to vendor. You will be notified once the vendor responds.',
                default => 'Order cancellation processed'
            };

            return response()->json([
                'message' => $message,
                'cancellation_type' => $order->cancellation_type,
                'data' => $order,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Check Cancellation Status
     *
     * Check if an order can be cancelled and what type of cancellation is available.
     *
     * @authenticated
     *
     * @urlParam order integer required The order ID. Example: 1
     *
     * @response {
     *   "can_cancel_immediately": true,
     *   "can_request_cancellation": true,
     *   "time_remaining_minutes": 25,
     *   "cancellation_deadline": "2024-01-01T00:30:00.000000Z",
     *   "current_status": "paid",
     *   "message": "You can cancel this order immediately for the next 25 minutes."
     * }
     * @response scenario="After 30 Minutes" {
     *   "can_cancel_immediately": false,
     *   "can_request_cancellation": true,
     *   "time_remaining_minutes": 0,
     *   "cancellation_deadline": "2024-01-01T00:30:00.000000Z",
     *   "current_status": "paid",
     *   "message": "You can request cancellation. The vendor will need to approve your request."
     * }
     */
    public function checkCancellationStatus(Order $order): JsonResponse
    {
        $this->authorize('view', $order);

        $canCancelImmediately = $order->canCancelImmediately();
        $canRequestCancellation = $order->canRequestCancellation();
        $timeRemaining = $order->getCancellationTimeRemaining();
        $cancellationDeadline = $order->created_at->copy()->addMinutes(30);

        // Generate helpful message
        $message = match (true) {
            $canCancelImmediately => "You can cancel this order immediately for the next {$timeRemaining} minutes.",
            $canRequestCancellation => 'You can request cancellation. The vendor will need to approve your request.',
            $order->status === 'cancellation_requested' => 'Your cancellation request is pending vendor approval.',
            $order->status === 'cancelled' => 'This order has been cancelled.',
            default => 'This order cannot be cancelled at this time.'
        };

        return response()->json([
            'can_cancel_immediately' => $canCancelImmediately,
            'can_request_cancellation' => $canRequestCancellation,
            'time_remaining_minutes' => $timeRemaining,
            'cancellation_deadline' => $cancellationDeadline->toIso8601String(),
            'current_status' => $order->status,
            'cancellation_type' => $order->cancellation_type,
            'message' => $message,
        ]);
    }
}

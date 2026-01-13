<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

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
     *       "created_at": "2024-01-01T00:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function index(): JsonResponse
    {
        $orders = $this->orderService->getUserOrders(auth()->id());

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
     *     "items": [],
     *     "address": {}
     *   }
     * }
     */
    public function show(Order $order): JsonResponse
    {
        $this->authorize('view', $order);
        
        $order = $this->orderService->getOrderDetails($order);

        return response()->json([
            'data' => $order,
        ]);
    }

    /**
     * Cancel Order
     * 
     * Cancel an order (only if pending or paid status).
     * 
     * @authenticated
     * 
     * @urlParam order integer required The order ID. Example: 1
     * 
     * @response {
     *   "message": "Order cancelled successfully",
     *   "data": {
     *     "id": 1,
     *     "status": "cancelled"
     *   }
     * }
     */
    public function cancel(Order $order): JsonResponse
    {
        $this->authorize('cancel', $order);
        
        $order = $this->orderService->cancelOrder($order);

        return response()->json([
            'message' => 'Order cancelled successfully',
            'data' => $order,
        ]);
    }
}
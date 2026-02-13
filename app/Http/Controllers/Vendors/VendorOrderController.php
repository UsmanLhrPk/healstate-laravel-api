<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    /**
     * Get all orders for vendor
     */
    public function index(Request $request): JsonResponse
    {
        $vendor = auth()->user()->vendor;
        
        if (!$vendor) {
            return response()->json(['message' => 'Vendor not found'], 404);
        }

        $status = $request->query('status');
        $orders = $this->orderService->getVendorOrders($vendor->id, $status);

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * Update order status
     */
    public function updateStatus(Order $order, Request $request): JsonResponse
    {
        $vendor = auth()->user()->vendor;
        
        $validated = $request->validate([
            'status' => 'required|string|in:processing,shipped,delivered',
        ]);

        $order = $this->orderService->updateOrderStatus(
            $order, 
            $validated['status'],
            $vendor->id
        );

        return response()->json([
            'message' => 'Order status updated successfully',
            'data' => $order,
        ]);
    }

    /**
     * Vendor cancels order
     */
    public function cancelOrder(Order $order, Request $request): JsonResponse
    {
        $vendor = auth()->user()->vendor;
        
        if (!$vendor) {
            return response()->json(['message' => 'Vendor not found'], 404);
        }

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        try {
            $order = $this->orderService->vendorCancelOrder(
                $order, 
                $vendor->id,
                $validated['reason']
            );

            return response()->json([
                'message' => 'Order cancelled successfully',
                'data' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 403);
        }
    }

    /**
     * Approve cancellation request
     */
    public function approveCancellation(Order $order): JsonResponse
    {
        $vendor = auth()->user()->vendor;
        
        $order = $this->orderService->approveCancellation($order, $vendor->id);

        return response()->json([
            'message' => 'Cancellation approved successfully',
            'data' => $order,
        ]);
    }

    /**
     * Deny cancellation request
     */
    public function denyCancellation(Order $order, Request $request): JsonResponse
    {
        $vendor = auth()->user()->vendor;
        
        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $order = $this->orderService->denyCancellation(
            $order, 
            $vendor->id,
            $validated['reason'] ?? null
        );

        return response()->json([
            'message' => 'Cancellation request denied',
            'data' => $order,
        ]);
    }
}
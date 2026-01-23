<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
use App\Models\ServiceBooking;
use App\Notifications\OrderCancellationRequestNotification;
use App\Notifications\OrderCancelledNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function createOrder(?int $userId, ?string $sessionId, array $data, Address $address): Order
    {
        return DB::transaction(function () use ($userId, $sessionId, $data, $address) {
            // Get cart items with explicit relationship loading
            $cartItems = $this->cartService->getCart($userId, $sessionId);

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            // Debug logging
            Log::info('Cart items for order creation', [
                'count' => $cartItems->count(),
                'first_item' => $cartItems->first()?->toArray(),
            ]);

            $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $address->id,
                'subtotal' => $totals['subtotal'],
                'shipping' => $totals['shipping'],
                'total' => $totals['total'],
                'status' => 'pending',
                'payment_intent_id' => $data['payment_intent_id'] ?? null,
                'order_notes' => $data['order_notes'] ?? null,
            ]);

            foreach ($cartItems as $cartItem) {
                // Debug each cart item
                Log::info('Processing cart item', [
                    'cart_item_id' => $cartItem->id,
                    'product_id' => $cartItem->product_id,
                    'service_slot_id' => $cartItem->service_slot_id,
                    'product_loaded' => $cartItem->relationLoaded('product'),
                    'service_slot_loaded' => $cartItem->relationLoaded('serviceSlot'),
                ]);

                if ($cartItem->product_id) {
                    // Handle product order item
                    if (! $cartItem->product) {
                        throw new \Exception("Product not found for cart item {$cartItem->id}");
                    }

                    $price = $cartItem->variant ? $cartItem->variant->price : $cartItem->product->price;
                    $productName = $cartItem->product->name ?? $cartItem->product->title;

                    $order->items()->create([
                        'product_id' => $cartItem->product_id,
                        'variant_id' => $cartItem->variant_id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $productName,
                        'type' => 'product',
                    ]);

                } elseif ($cartItem->service_slot_id) {
                    // Handle service order item
                    if (! $cartItem->serviceSlot) {
                        throw new \Exception("Service slot not found for cart item {$cartItem->id}");
                    }

                    $price = $cartItem->serviceSlot->price;
                    $serviceName = $cartItem->serviceSlot->name ?? 'Service Appointment';

                    // Create service booking
                    $serviceBooking = ServiceBooking::create([
                        'service_slot_id' => $cartItem->service_slot_id,
                        'user_id' => $userId,
                        'order_id' => $order->id,
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                        'status' => 'confirmed',
                        'total_price' => $price,
                        'notes' => $data['order_notes'] ?? null,
                    ]);

                    // Create order item for the service
                    $order->items()->create([
                        'service_slot_id' => $cartItem->service_slot_id,
                        'service_booking_id' => $serviceBooking->id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $serviceName,
                        'type' => 'service',
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                    ]);

                } else {
                    throw new \Exception("Invalid cart item {$cartItem->id}: must have either product_id or service_slot_id");
                }
            }

            return $order->load(['items.product', 'items.variant', 'items.serviceSlot', 'address']);
        });
    }

    public function markOrderAsPaid(Order $order, string $paymentIntentId): Order
    {
        $order->update([
            'status' => 'paid',
            'payment_intent_id' => $paymentIntentId,
            'paid_at' => now(),
        ]);

        // Update service bookings status if any
        $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
            if ($item->serviceBooking) {
                $item->serviceBooking->update(['status' => 'confirmed']);
            }
        });

        return $order->fresh();
    }

    public function getUserOrders(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Order::where('user_id', $userId)
            ->with(['items.product', 'items.variant', 'items.serviceSlot', 'address'])
            ->latest()
            ->paginate($perPage);
    }

    public function getOrderDetails(Order $order): Order
    {
        return $order->load([
            'items.product.vendor',
            'items.variant',
            'items.serviceSlot',
            'address',
        ]);
    }

    /**
     * Cancel order - handles both immediate and requested cancellations
     */
    public function cancelOrder(Order $order, ?string $reason = null): Order
    {
        return DB::transaction(function () use ($order, $reason) {
            // Check if can cancel immediately (within 30 minutes)
            if ($order->canCancelImmediately()) {
                return $this->processImmediateCancellation($order, $reason);
            }

            // Otherwise, create cancellation request
            if ($order->canRequestCancellation()) {
                return $this->requestCancellation($order, $reason);
            }

            throw new \Exception('Order cannot be cancelled at this time');
        });
    }

    /**
     * Process immediate cancellation (within 30 minutes)
     */
    protected function processImmediateCancellation(Order $order, ?string $reason): Order
    {
        $order->update([
            'status' => 'cancelled',
            'cancellation_type' => 'immediate',
            'cancelled_by' => 'user',
            'cancellation_reason' => $reason,
            'cancellation_requested_at' => now(),
        ]);

        // Cancel service bookings if any
        $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
            if ($item->serviceBooking) {
                $item->serviceBooking->update(['status' => 'cancelled']);
            }
        });

        // Notify user
        $order->user->notify(new OrderCancelledNotification($order));

        // Notify vendors
        $this->notifyVendorsOfCancellation($order);

        return $order->fresh();
    }

    /**
     * Request cancellation (after 30 minutes - needs vendor approval)
     */
    protected function requestCancellation(Order $order, ?string $reason): Order
    {
        $order->update([
            'status' => 'cancellation_requested',
            'cancellation_type' => 'requested',
            'cancellation_reason' => $reason,
            'cancellation_requested_at' => now(),
        ]);

        // Notify vendors about cancellation request
        $this->notifyVendorsOfCancellationRequest($order);

        return $order->fresh();
    }

    /**
     * Vendor approves cancellation request
     */
    public function approveCancellation(Order $order, int $vendorId): Order
    {
        if ($order->status !== 'cancellation_requested') {
            throw new \Exception('No pending cancellation request for this order');
        }

        return DB::transaction(function () use ($order) {
            $order->update([
                'status' => 'cancelled',
                'cancelled_by' => 'vendor',
            ]);

            // Cancel service bookings if any
            $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
                if ($item->serviceBooking) {
                    $item->serviceBooking->update(['status' => 'cancelled']);
                }
            });

            // Notify user that cancellation was approved
            $order->user->notify(new OrderCancelledNotification($order, true));

            return $order->fresh();
        });
    }

    /**
     * Vendor denies cancellation request
     */
    public function denyCancellation(Order $order, int $vendorId, ?string $reason = null): Order
    {
        if ($order->status !== 'cancellation_requested') {
            throw new \Exception('No pending cancellation request for this order');
        }

        $order->update([
            'status' => 'paid', // or previous status
            'cancellation_requested_at' => null,
            'cancellation_reason' => null,
            'cancellation_type' => null,
        ]);

        $order->user->notify(new OrderCancellationDeniedNotification($order, $reason));

        return $order->fresh();
    }

    /**
     * Notify vendors about immediate cancellation
     */
    protected function notifyVendorsOfCancellation(Order $order): void
    {
        $vendorIds = $order->getVendorIds();

        foreach ($vendorIds as $vendorId) {
            $vendor = \App\Models\Vendor::find($vendorId);
            if ($vendor && $vendor->user) {
                $vendor->user->notify(new VendorOrderCancelledNotification($order));
            }
        }
    }

    /**
     * Notify vendors about cancellation request (needs approval)
     */
    protected function notifyVendorsOfCancellationRequest(Order $order): void
    {
        $vendorIds = $order->getVendorIds();

        foreach ($vendorIds as $vendorId) {
            $vendor = \App\Models\Vendor::find($vendorId);
            if ($vendor && $vendor->user) {
                $vendor->user->notify(new OrderCancellationRequestNotification($order));
            }
        }
    }

    public function updateOrderStatus(Order $order, string $status, ?int $vendorId = null): Order
    {
        $validStatuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (! in_array($status, $validStatuses)) {
            throw new \Exception('Invalid order status');
        }

        // If vendor is updating to cancelled status, it's approving a cancellation
        if ($status === 'cancelled' && $vendorId && $order->status === 'cancellation_requested') {
            return $this->approveCancellation($order, $vendorId);
        }

        $order->update(['status' => $status]);

        return $order->fresh();
    }

    /**
 * Vendor cancels order with reason
 */
public function vendorCancelOrder(Order $order, int $vendorId, string $reason): Order
{
    // Verify this vendor owns products in this order
    $hasVendorProducts = $order->items()
        ->where(function ($q) use ($vendorId) {
            $q->whereHas('product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->orWhereHas('serviceSlot.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            });
        })
        ->exists();

    if (!$hasVendorProducts) {
        throw new \Exception('You do not have permission to cancel this order');
    }

    return DB::transaction(function () use ($order, $reason) {
        $order->update([
            'status' => 'cancelled',
            'cancellation_type' => 'vendor_initiated',
            'cancelled_by' => 'vendor',
            'cancellation_reason' => $reason,
            'cancellation_requested_at' => now(),
        ]);

        // Cancel service bookings if any
        $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
            if ($item->serviceBooking) {
                $item->serviceBooking->update(['status' => 'cancelled']);
            }
        });

        // Restore product stock if applicable
        $order->items()->whereNotNull('variant_id')->each(function ($item) {
            if ($item->variant && $item->variant->stock !== null) {
                $item->variant->increment('stock', $item->quantity);
            }
        });

        // Notify user about vendor cancellation
        // if ($order->user) {
        //     $order->user->notify(new \App\Notifications\VendorCancelledOrderNotification($order, $reason));
        // }

        return $order->fresh();
    });
}


    /**
     * Get vendor orders with cancellation requests
     * Fixed to handle both product and service orders
     */
    public function getVendorOrders(int $vendorId, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Order::where(function ($q) use ($vendorId) {
            // Orders with product items from this vendor
            $q->whereHas('items.product', function ($productQuery) use ($vendorId) {
                $productQuery->where('vendor_id', $vendorId);
            })
            // OR orders with service items from this vendor
                ->orWhereHas('items.serviceSlot', function ($serviceQuery) use ($vendorId) {
                    $serviceQuery->whereHas('product', function ($productQuery) use ($vendorId) {
                        $productQuery->where('vendor_id', $vendorId);
                    });
                });
        })
            ->with([
                'items.product',
                'items.variant',
                'items.serviceSlot.product', // Important: load product through serviceSlot
                'address',
                'user',
            ]);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->latest()->paginate($perPage);
    }
}

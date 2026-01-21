<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ServiceBooking;
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
                    if (!$cartItem->product) {
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
                    if (!$cartItem->serviceSlot) {
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
            'address'
        ]);
    }

    public function cancelOrder(Order $order): Order
    {
        if (! in_array($order->status, ['pending', 'paid'])) {
            throw new \Exception('Order cannot be cancelled');
        }

        $order->update(['status' => 'cancelled']);

        // Cancel service bookings if any
        $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
            if ($item->serviceBooking) {
                $item->serviceBooking->update(['status' => 'cancelled']);
            }
        });

        return $order->fresh();
    }

    public function updateOrderStatus(Order $order, string $status): Order
    {
        $validStatuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (! in_array($status, $validStatuses)) {
            throw new \Exception('Invalid order status');
        }

        $order->update(['status' => $status]);

        return $order->fresh();
    }
}
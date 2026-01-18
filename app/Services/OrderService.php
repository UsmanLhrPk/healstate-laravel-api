<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
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
                    'product_loaded' => $cartItem->relationLoaded('product'),
                    'product_exists' => isset($cartItem->product),
                    'product_id' => $cartItem->product_id,
                    'product_data' => $cartItem->product?->toArray(),
                ]);

                // Verify product exists
                if (! $cartItem->product) {
                    throw new \Exception("Product not found for cart item {$cartItem->id}");
                }

                $price = $cartItem->variant ? $cartItem->variant->price : $cartItem->product->price;
                $productName = $cartItem->product->name;

                Log::info('Creating order item', [
                    'product_name' => $productName,
                    'price' => $price,
                ]);

                $order->items()->create([
                    'product_id' => $cartItem->product_id,
                    'variant_id' => $cartItem->variant_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $price,
                    'subtotal' => $price * $cartItem->quantity,
                    'product_name' => $cartItem->product->title,
                ]);
            }

            return $order->load(['items.product', 'items.variant', 'address']);
        });
    }

    public function markOrderAsPaid(Order $order, string $paymentIntentId): Order
    {
        $order->update([
            'status' => 'paid',
            'payment_intent_id' => $paymentIntentId,
            'paid_at' => now(),
        ]);

        return $order->fresh();
    }

    public function getUserOrders(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Order::where('user_id', $userId)
            ->with(['items.product', 'items.variant', 'address'])
            ->latest()
            ->paginate($perPage);
    }

    public function getOrderDetails(Order $order): Order
    {
        return $order->load(['items.product.vendor', 'items.variant', 'address']);
    }

    public function cancelOrder(Order $order): Order
    {
        if (! in_array($order->status, ['pending', 'paid'])) {
            throw new \Exception('Order cannot be cancelled');
        }

        $order->update(['status' => 'cancelled']);

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

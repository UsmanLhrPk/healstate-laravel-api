<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function createOrder(?int $userId, ?string $sessionId, array $data, Address $address): Order
    {
        return DB::transaction(function () use ($userId, $sessionId, $data, $address) {
            $cartItems = $this->cartService->getCart($userId, $sessionId);

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $address->id,
                'subtotal' => $totals['subtotal'],
                'tax' => $totals['tax'],
                'shipping' => $totals['shipping'],
                'total' => $totals['total'],
                'status' => 'pending',
                'payment_intent_id' => $data['payment_intent_id'] ?? null,
                'order_notes' => $data['order_notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                $price = $item->variant ? $item->variant->price : $item->product->price;
                
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $price,
                    'subtotal' => $price * $item->quantity,
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
        if (!in_array($order->status, ['pending', 'paid'])) {
            throw new \Exception('Order cannot be cancelled');
        }

        $order->update(['status' => 'cancelled']);
        
        return $order->fresh();
    }

    public function updateOrderStatus(Order $order, string $status): Order
    {
        $validStatuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        if (!in_array($status, $validStatuses)) {
            throw new \Exception('Invalid order status');
        }

        $order->update(['status' => $status]);
        
        return $order->fresh();
    }
}
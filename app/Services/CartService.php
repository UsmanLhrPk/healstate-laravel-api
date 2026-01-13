<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function addToCart(?int $userId, ?string $sessionId, array $data): Cart
    {
        return DB::transaction(function () use ($userId, $sessionId, $data) {
            $existing = Cart::where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
                ->where('product_id', $data['product_id'])
                ->where('variant_id', $data['variant_id'] ?? null)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $data['quantity']);
                return $existing->fresh(['product', 'variant']);
            }

            $cartData = [
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $data['product_id'],
                'variant_id' => $data['variant_id'] ?? null,
                'quantity' => $data['quantity'],
            ];

            return Cart::create($cartData)->load(['product', 'variant']);
        });
    }

    public function getCart(?int $userId, ?string $sessionId): Collection
    {
        $query = Cart::with(['product.vendor', 'variant'])
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            });

        return $query->get();
    }

    public function updateCartItem(Cart $cart, int $quantity): Cart
    {
        $cart->update(['quantity' => $quantity]);
        return $cart->fresh(['product', 'variant']);
    }

    public function removeFromCart(Cart $cart): bool
    {
        return $cart->delete();
    }

    public function clearCart(?int $userId, ?string $sessionId): bool
    {
        return Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();
    }

    public function getCartCount(?int $userId, ?string $sessionId): int
    {
        return Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->count();
    }

    public function calculateCartTotals(?int $userId, ?string $sessionId): array
    {
        $cartItems = $this->getCart($userId, $sessionId);

        $subtotal = $cartItems->sum(function ($item) {
            $price = $item->variant ? $item->variant->price : $item->product->price;
            return $price * $item->quantity;
        });

        // Tax calculation. stripe charges 2.9 percent + 30 cents per transaction
        $commissionFee = 0.029 * $subtotal + 0.30;

        // Shipping calculation (flat rate or free over certain amount)
        $shipping = 0;

        $total = $subtotal + $commissionFee + $shipping;

        return [
            'subtotal' => round($subtotal, 2),
            'shipping' => round($shipping, 2),
            'total' => round($total, 2),
        ];
    }

    public function mergeGuestCart(int $userId, string $sessionId): void
    {
        DB::transaction(function () use ($userId, $sessionId) {
            $guestCartItems = Cart::where('session_id', $sessionId)->get();

            foreach ($guestCartItems as $guestItem) {
                $existingItem = Cart::where('user_id', $userId)
                    ->where('product_id', $guestItem->product_id)
                    ->where('variant_id', $guestItem->variant_id)
                    ->first();

                if ($existingItem) {
                    $existingItem->increment('quantity', $guestItem->quantity);
                    $guestItem->delete();
                } else {
                    $guestItem->update([
                        'user_id' => $userId,
                        'session_id' => null,
                    ]);
                }
            }
        });
    }
}
<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function addToCart(?int $userId, ?string $sessionId, array $data): Cart
    {
        return DB::transaction(function () use ($userId, $sessionId, $data) {
            // Check if adding a service
            if (isset($data['service_slot_id'])) {
                // Check for duplicate service in cart
                $existing = Cart::where(function ($query) use ($userId, $sessionId) {
                    if ($userId) {
                        $query->where('user_id', $userId);
                    } else {
                        $query->where('session_id', $sessionId);
                    }
                })
                    ->where('service_slot_id', $data['service_slot_id'])
                    ->where('booking_date', $data['booking_date'])
                    ->where('start_time', $data['start_time'])
                    ->first();

                if ($existing) {
                    // Services can't have quantity > 1, so just return existing
                    return $existing->fresh(['serviceSlot']);
                }

                $cartData = [
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'service_slot_id' => $data['service_slot_id'],
                    'booking_date' => $data['booking_date'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'quantity' => 1, // Services always quantity 1
                ];

                return Cart::create($cartData)->load(['serviceSlot']);
            } else {
                // Product logic (existing code)
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
            }
        });
    }

    public function getCart(?int $userId, ?string $sessionId): Collection
    {
        $query = Cart::with(['product.vendor', 'variant', 'serviceSlot.product.vendor'])
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->where(function ($query) {
                // Only get valid cart items
                $query->whereNotNull('product_id')
                    ->orWhereNotNull('service_slot_id');
            });

        return $query->get();
    }

    public function updateCartItem(Cart $cart, int $quantity): Cart
    {
        // Don't allow updating quantity for services (always 1)
        if ($cart->service_slot_id) {
            return $cart->fresh(['serviceSlot']);
        }

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
        })
            ->where(function ($query) {
                // Only count valid items
                $query->whereNotNull('product_id')
                    ->orWhereNotNull('service_slot_id');
            })
            ->sum('quantity');
    }

    /**
     * Get currency for a cart item
     */
    private function getItemCurrency($item): string
    {
        if ($item->product_id && $item->product) {
            return $item->product->currency ?? $item->product->vendor->currency ?? 'USD';
        } elseif ($item->service_slot_id && $item->serviceSlot) {
            return $item->serviceSlot->product->currency ?? $item->serviceSlot->product->vendor->currency ?? 'USD';
        }
        
        return 'USD';
    }

    /**
     * Get currency symbol for a cart item
     */
    private function getItemCurrencySymbol($item): string
    {
        if ($item->product_id && $item->product) {
            return $item->product->currency_symbol ?? $item->product->vendor->currency_symbol ?? '$';
        } elseif ($item->service_slot_id && $item->serviceSlot) {
            return $item->serviceSlot->product->currency_symbol ?? $item->serviceSlot->product->vendor->currency_symbol ?? '$';
        }
        
        return '$';
    }

    /**
     * Group cart items by currency
     */
    public function getCartGroupedByCurrency(?int $userId, ?string $sessionId): Collection
    {
        $cartItems = $this->getCart($userId, $sessionId);

        if ($cartItems->isEmpty()) {
            return collect();
        }

        // Group items by currency
        $grouped = $cartItems->groupBy(function ($item) {
            return $this->getItemCurrency($item);
        });

        return $grouped->map(function ($items, $currency) {
            $currencySymbol = $this->getItemCurrencySymbol($items->first());
            
            $subtotal = $items->sum(function ($item) {
                if ($item->product_id) {
                    $price = $item->variant ? $item->variant->price : ($item->product ? $item->product->price : 0);
                    return $price * $item->quantity;
                } elseif ($item->service_slot_id) {
                    $price = $item->serviceSlot ? $item->serviceSlot->price : 0;
                    return $price * $item->quantity;
                }
                return 0;
            });

            // Stripe charges 2.9% + 30 cents per transaction
            $commissionFee = 0.029 * $subtotal + 0.30;
            $shipping = 0;
            $total = $subtotal + $commissionFee + $shipping;

            return [
                'currency' => $currency,
                'currency_symbol' => $currencySymbol,
                'items' => $items,
                'subtotal' => round($subtotal, 2),
                'shipping' => round($shipping, 2),
                'commission_fee' => round($commissionFee, 2),
                'total' => round($total, 2),
            ];
        });
    }

    /**
     * Calculate totals for a specific currency
     */
    public function calculateCartTotalsForCurrency(?int $userId, ?string $sessionId, string $currency): array
    {
        $cartItems = $this->getCart($userId, $sessionId)->filter(function ($item) use ($currency) {
            return $this->getItemCurrency($item) === $currency;
        });

        if ($cartItems->isEmpty()) {
            return [
                'subtotal' => 0,
                'shipping' => 0,
                'commission_fee' => 0,
                'total' => 0,
                'currency' => $currency,
                'currency_symbol' => $this->getCurrencySymbol($currency),
            ];
        }

        $currencySymbol = $this->getItemCurrencySymbol($cartItems->first());

        $subtotal = $cartItems->sum(function ($item) {
            if ($item->product_id) {
                $price = $item->variant ? $item->variant->price : ($item->product ? $item->product->price : 0);
                return $price * $item->quantity;
            } elseif ($item->service_slot_id) {
                $price = $item->serviceSlot ? $item->serviceSlot->price : 0;
                return $price * $item->quantity;
            }
            return 0;
        });

        // Stripe charges 2.9% + 30 cents per transaction
        $commissionFee = 0.029 * $subtotal + 0.30;
        $shipping = 0;
        $total = $subtotal + $commissionFee + $shipping;

        return [
            'subtotal' => round($subtotal, 2),
            'shipping' => round($shipping, 2),
            'commission_fee' => round($commissionFee, 2),
            'total' => round($total, 2),
            'currency' => $currency,
            'currency_symbol' => $currencySymbol,
        ];
    }

    /**
     * Calculate cart totals (legacy method - now returns all currencies)
     */
    public function calculateCartTotals(?int $userId, ?string $sessionId): array
    {
        $grouped = $this->getCartGroupedByCurrency($userId, $sessionId);

        if ($grouped->isEmpty()) {
            return [
                'currencies' => [],
                'has_multiple_currencies' => false,
            ];
        }

        // If only one currency, return it in the old format for backward compatibility
        if ($grouped->count() === 1) {
            $single = $grouped->first();
            return [
                'subtotal' => $single['subtotal'],
                'shipping' => $single['shipping'],
                'commission_fee' => $single['commission_fee'],
                'total' => $single['total'],
                'currency' => $single['currency'],
                'currency_symbol' => $single['currency_symbol'],
                'has_multiple_currencies' => false,
            ];
        }

        // Multiple currencies - return all
        return [
            'currencies' => $grouped->map(fn($g) => [
                'subtotal' => $g['subtotal'],
                'shipping' => $g['shipping'],
                'commission_fee' => $g['commission_fee'],
                'total' => $g['total'],
                'currency' => $g['currency'],
                'currency_symbol' => $g['currency_symbol'],
            ])->values()->toArray(),
            'has_multiple_currencies' => true,
        ];
    }

    /**
     * Get default currency symbol
     */
    private function getCurrencySymbol(string $currency): string
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'JPY' => '¥',
            'AUD' => 'A$',
            'CAD' => 'C$',
            'CHF' => 'CHF',
            'CNY' => '¥',
            'SEK' => 'kr',
            'NZD' => 'NZ$',
        ];

        return $symbols[$currency] ?? $currency;
    }

    public function mergeGuestCart(int $userId, string $sessionId): void
    {
        \Log::info('mergeGuestCart called', [
            'user_id' => $userId,
            'session_id' => $sessionId,
        ]);

        DB::transaction(function () use ($userId, $sessionId) {
            $guestCartItems = Cart::where('session_id', $sessionId)->get();

            \Log::info('Guest cart items found', [
                'count' => $guestCartItems->count(),
                'items' => $guestCartItems->pluck('id')->toArray(),
            ]);

            foreach ($guestCartItems as $guestItem) {
                if ($guestItem->product_id) {
                    // Merge product items
                    $existingItem = Cart::where('user_id', $userId)
                        ->where('product_id', $guestItem->product_id)
                        ->where('variant_id', $guestItem->variant_id)
                        ->first();

                    if ($existingItem) {
                        \Log::info('Merging product with existing item', [
                            'guest_item_id' => $guestItem->id,
                            'existing_item_id' => $existingItem->id,
                        ]);

                        $existingItem->increment('quantity', $guestItem->quantity);
                        $guestItem->delete();
                    } else {
                        \Log::info('Updating guest product item to user item', [
                            'guest_item_id' => $guestItem->id,
                        ]);

                        $guestItem->update([
                            'user_id' => $userId,
                            'session_id' => null,
                        ]);
                    }
                } elseif ($guestItem->service_slot_id) {
                    // Merge service items - check for duplicates by date/time
                    $existingService = Cart::where('user_id', $userId)
                        ->where('service_slot_id', $guestItem->service_slot_id)
                        ->where('booking_date', $guestItem->booking_date)
                        ->where('start_time', $guestItem->start_time)
                        ->first();

                    if ($existingService) {
                        \Log::info('Service already exists in user cart, deleting guest item', [
                            'guest_item_id' => $guestItem->id,
                            'existing_item_id' => $existingService->id,
                        ]);

                        $guestItem->delete();
                    } else {
                        \Log::info('Updating guest service item to user item', [
                            'guest_item_id' => $guestItem->id,
                        ]);

                        $guestItem->update([
                            'user_id' => $userId,
                            'session_id' => null,
                        ]);
                    }
                }
            }

            \Log::info('mergeGuestCart completed successfully');
        });
    }
}
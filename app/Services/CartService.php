<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CartService
{
    // ── Add to cart ───────────────────────────────────────────────────────────

    public function addToCart(?int $userId, ?string $sessionId, array $data): Cart
    {
        return DB::transaction(function () use ($userId, $sessionId, $data) {

            // ── Healer / practitioner offering slot ───────────────────────
            if (isset($data['practitioner_offering_slot_id'])) {
                $existing = $this->findCartRow($userId, $sessionId)
                    ->where('practitioner_offering_slot_id', $data['practitioner_offering_slot_id'])
                    ->where('booking_date', $data['booking_date'])
                    ->where('start_time', $data['start_time'])
                    ->first();

                if ($existing) {
                    return $existing->load('practitionerOfferingSlot.offering');
                }

                return Cart::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'practitioner_offering_slot_id' => $data['practitioner_offering_slot_id'],
                    'booking_date' => $data['booking_date'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'quantity' => 1,
                ])->load('practitionerOfferingSlot.offering');
            }

            // ── Legacy vendor service slot ────────────────────────────────
            if (isset($data['service_slot_id'])) {
                $existing = $this->findCartRow($userId, $sessionId)
                    ->where('service_slot_id', $data['service_slot_id'])
                    ->where('booking_date', $data['booking_date'])
                    ->where('start_time', $data['start_time'])
                    ->first();

                if ($existing) {
                    return $existing->load('serviceSlot');
                }

                return Cart::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'service_slot_id' => $data['service_slot_id'],
                    'booking_date' => $data['booking_date'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'quantity' => 1,
                ])->load('serviceSlot');
            }

            // ── Physical product ──────────────────────────────────────────
            $existing = $this->findCartRow($userId, $sessionId)
                ->where('product_id', $data['product_id'])
                ->where('variant_id', $data['variant_id'] ?? null)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $data['quantity']);

                return $existing->fresh(['product', 'variant']);
            }

            return Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $data['product_id'],
                'variant_id' => $data['variant_id'] ?? null,
                'quantity' => $data['quantity'],
            ])->load(['product', 'variant']);
        });
    }

    // ── Get cart ──────────────────────────────────────────────────────────────

    public function getCart(?int $userId, ?string $sessionId): Collection
    {
        return Cart::with([
            'product.vendor',
            'variant',
            // Legacy vendor service
            'serviceSlot.product.vendor',
            // Healer offering
            'practitionerOfferingSlot.offering.practitioner.user',
        ])
            ->where(function ($q) use ($userId, $sessionId) {
                $this->scopeToOwner($q, $userId, $sessionId);
            })
            ->where(function ($q) {
                $q->whereNotNull('product_id')
                    ->orWhereNotNull('service_slot_id')
                    ->orWhereNotNull('practitioner_offering_slot_id');
            })
            ->get();
    }

    // ── Update / remove / clear ───────────────────────────────────────────────

    public function updateCartItem(Cart $cart, int $quantity): Cart
    {
        // Bookings are always quantity 1 — ignore update silently
        if ($cart->isPractitionerBooking() || $cart->isServiceBooking()) {
            return $cart->load($this->relationsForItem($cart));
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
        return Cart::where(function ($q) use ($userId, $sessionId) {
            $this->scopeToOwner($q, $userId, $sessionId);
        })->delete();
    }

    // ── Count ─────────────────────────────────────────────────────────────────

    public function getCartCount(?int $userId, ?string $sessionId): int
    {
        return Cart::where(function ($q) use ($userId, $sessionId) {
            $this->scopeToOwner($q, $userId, $sessionId);
        })
            ->where(function ($q) {
                $q->whereNotNull('product_id')
                    ->orWhereNotNull('service_slot_id')
                    ->orWhereNotNull('practitioner_offering_slot_id');
            })
            ->sum('quantity');
    }

    // ── Totals (multi-currency) ───────────────────────────────────────────────

    public function calculateCartTotals(?int $userId, ?string $sessionId): array
    {
        $grouped = $this->getCartGroupedByCurrency($userId, $sessionId);

        if ($grouped->isEmpty()) {
            return [
                'subtotal' => 0,
                'shipping' => 0,
                'commission_fee' => 0,
                'total' => 0,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'has_multiple_currencies' => false,
                'currencies' => [],
            ];
        }

        if ($grouped->count() === 1) {
            $single = $grouped->first();

            return array_merge($single, ['has_multiple_currencies' => false]);
        }

        return [
            'currencies' => $grouped->map(fn ($g) => collect($g)->except('items'))->values()->toArray(),
            'has_multiple_currencies' => true,
        ];
    }

    /**
     * Calculate cart totals for a specific currency.
     * Called by OrderService::createOrderForCurrency().
     */
    public function calculateCartTotalsForCurrency(?int $userId, ?string $sessionId, string $currency): array
    {
        $grouped = $this->getCartGroupedByCurrency($userId, $sessionId);

        $currencyData = $grouped->get($currency);

        if (! $currencyData) {
            return [
                'currency' => $currency,
                'currency_symbol' => '$',
                'subtotal' => 0,
                'shipping' => 0,
                'commission_fee' => 0,
                'total' => 0,
            ];
        }

        return $currencyData;
    }

    public function getCartGroupedByCurrency(?int $userId, ?string $sessionId): Collection
    {
        $items = $this->getCart($userId, $sessionId);

        if ($items->isEmpty()) {
            return collect();
        }

        return $items->groupBy(fn ($item) => $this->itemCurrency($item))
            ->map(function ($groupItems, $currency) {
                $symbol = $this->itemCurrencySymbol($groupItems->first());
                $subtotal = $groupItems->sum(fn ($item) => $this->itemPrice($item) * $item->quantity);

                $commissionFee = round(0.029 * $subtotal + 0.30, 2);
                $shipping = 0;
                $total = round($subtotal + $commissionFee + $shipping, 2);

                return [
                    'currency' => $currency,
                    'currency_symbol' => $symbol,
                    'items' => $groupItems,
                    'subtotal' => round($subtotal, 2),
                    'shipping' => $shipping,
                    'commission_fee' => $commissionFee,
                    'total' => $total,
                ];
            });
    }

    // ── Guest → user cart merge ───────────────────────────────────────────────

    public function mergeGuestCart(int $userId, string $sessionId): void
    {
        DB::transaction(function () use ($userId, $sessionId) {
            $guestItems = Cart::where('session_id', $sessionId)->get();

            foreach ($guestItems as $item) {
                if ($item->isPractitionerBooking()) {
                    $exists = Cart::where('user_id', $userId)
                        ->where('practitioner_offering_slot_id', $item->practitioner_offering_slot_id)
                        ->where('booking_date', $item->booking_date)
                        ->where('start_time', $item->start_time)
                        ->exists();

                    $exists
                        ? $item->delete()
                        : $item->update(['user_id' => $userId, 'session_id' => null]);

                } elseif ($item->isServiceBooking()) {
                    $exists = Cart::where('user_id', $userId)
                        ->where('service_slot_id', $item->service_slot_id)
                        ->where('booking_date', $item->booking_date)
                        ->where('start_time', $item->start_time)
                        ->exists();

                    $exists
                        ? $item->delete()
                        : $item->update(['user_id' => $userId, 'session_id' => null]);

                } elseif ($item->isProduct()) {
                    $existing = Cart::where('user_id', $userId)
                        ->where('product_id', $item->product_id)
                        ->where('variant_id', $item->variant_id)
                        ->first();

                    if ($existing) {
                        $existing->increment('quantity', $item->quantity);
                        $item->delete();
                    } else {
                        $item->update(['user_id' => $userId, 'session_id' => null]);
                    }
                }
            }
        });
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    /** Base query scoped to the current user or session */
    private function findCartRow(?int $userId, ?string $sessionId)
    {
        return Cart::where(function ($q) use ($userId, $sessionId) {
            $this->scopeToOwner($q, $userId, $sessionId);
        });
    }

    private function scopeToOwner($query, ?int $userId, ?string $sessionId): void
    {
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }
    }

    private function itemPrice(Cart $item): float
    {
        if ($item->isPractitionerBooking()) {
            return (float) ($item->practitionerOfferingSlot?->price ?? 0);
        }

        if ($item->isServiceBooking()) {
            return (float) ($item->serviceSlot?->price ?? 0);
        }

        // Physical product — variant price takes precedence
        return (float) ($item->variant?->price ?? $item->product?->price ?? 0);
    }

    private function itemCurrency(Cart $item): string
    {
        if ($item->isPractitionerBooking()) {
            // Healer offerings are always USD (no per-vendor currency)
            return 'USD';
        }

        if ($item->isServiceBooking()) {
            return $item->serviceSlot?->product?->currency
                ?? $item->serviceSlot?->product?->vendor?->currency
                ?? 'USD';
        }

        return $item->product?->currency
            ?? $item->product?->vendor?->currency
            ?? 'USD';
    }

    private function itemCurrencySymbol(Cart $item): string
    {
        if ($item->isPractitionerBooking()) {
            return '$';
        }

        if ($item->isServiceBooking()) {
            return $item->serviceSlot?->product?->currency_symbol
                ?? $item->serviceSlot?->product?->vendor?->currency_symbol
                ?? '$';
        }

        return $item->product?->currency_symbol
            ?? $item->product?->vendor?->currency_symbol
            ?? '$';
    }

    private function relationsForItem(Cart $item): array
    {
        if ($item->isPractitionerBooking()) {
            return ['practitionerOfferingSlot.offering'];
        }

        if ($item->isServiceBooking()) {
            return ['serviceSlot'];
        }

        return ['product', 'variant'];
    }

    private function getCurrencySymbol(string $currency): string
    {
        return [
            'USD' => '$', 'EUR' => '€', 'GBP' => '£',
            'JPY' => '¥', 'AUD' => 'A$', 'CAD' => 'C$',
            'CHF' => 'CHF', 'CNY' => '¥', 'SEK' => 'kr', 'NZD' => 'NZ$',
        ][$currency] ?? $currency;
    }
}

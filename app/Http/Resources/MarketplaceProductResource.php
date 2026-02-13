<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketplaceProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Calculate minimum price
        $variantPrices = $this->variants->pluck('price')->filter();
        $slotPrices = $this->serviceSlots->pluck('price')->filter();
        $allPrices = $variantPrices->concat($slotPrices);
        $minPrice = $allPrices->min() ?? 0;

        // Get full image URL
        $imageUrl = null;
        if (!empty($this->images) && isset($this->images[0])) {
            $imageUrl = url($this->images[0]);
        }

        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'title' => $this->title,
            'brief' => $this->brief,
            'description' => $this->description,
            'type' => $this->type,
            'image_url' => $imageUrl,
            'active' => $this->active,
            'currency' => $this->vendor->currency,
            'currency_symbol' => $this->vendor->getCurrencySymbol(),
            'variants' => $this->when(
                $this->type === 'product' && $this->variants,
                $this->variants->map(function ($variant) {
                    return [
                        'id' => $variant->id,
                        'name' => $variant->name,
                        'price' => $variant->price,
                        'stock' => $variant->stock,
                        'currency' => $this->vendor->currency,
                        'currency_symbol' => $this->vendor->getCurrencySymbol(),
                    ];
                })
            ),
            'service_slots' => $this->when(
                $this->type === 'service' && $this->serviceSlots,
                $this->serviceSlots->map(function ($slot) {
                    return [
                        'id' => $slot->id,
                        'duration' => $slot->duration,
                        'price' => $slot->price,
                        'currency' => $this->vendor->currency,
                        'currency_symbol' => $this->vendor->getCurrencySymbol(),
                    ];
                })
            ),
            'vendor' => [
                'id' => $this->vendor->id,
                'business_name' => $this->vendor->business_name,
                'category' => $this->vendor->category,
                'city' => $this->vendor->city,
                'average_rating' => $this->vendor->average_rating,
                'review_count' => $this->vendor->review_count,
                'is_verified' => $this->vendor->isVerified(),
                'currency' => $this->vendor->currency,
                'currency_symbol' => $this->vendor->getCurrencySymbol(),
            ],
            'min_price' => number_format($minPrice, 2, '.', ''),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
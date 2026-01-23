<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'business_name' => $this->business_name,
            'brief' => $this->brief,
            'category' => $this->category,
            'website' => $this->website,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state_province' => $this->state_province,
            'postal_code' => $this->postal_code,
            'currency' => $this->currency,
            'currency_symbol' => $this->getCurrencySymbol(),
            'currency_name' => $this->getCurrencyName(),
            'verified_at' => $this->verified_at,
            'is_verified' => $this->isVerified(),
            'average_rating' => $this->average_rating,
            'review_count' => $this->review_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
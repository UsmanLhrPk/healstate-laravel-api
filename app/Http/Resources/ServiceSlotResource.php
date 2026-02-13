<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceSlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'duration' => $this->duration,
            'price' => $this->price,
            'currency' => $this->currency,
            'currency_symbol' => $this->currency_symbol,
            'formatted_price' => $this->formatted_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
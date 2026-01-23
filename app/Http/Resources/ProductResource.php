<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'title' => $this->title,
            'brief' => $this->brief,
            'description' => $this->description,
            'type' => $this->type,
            'active' => $this->active,
            'images' => $this->images ?? [],
            'currency' => $this->currency,
            'currency_symbol' => $this->currency_symbol,
            'vendor' => new VendorResource($this->whenLoaded('vendor')),
            'variants' => ProductVariantResource::collection($this->whenLoaded('variants')),
            'service_slots' => ServiceSlotResource::collection($this->whenLoaded('serviceSlots')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
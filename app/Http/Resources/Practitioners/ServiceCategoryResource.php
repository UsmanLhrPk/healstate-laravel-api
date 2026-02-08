<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'display_order' => $this->display_order,
            'is_active' => $this->is_active,
            'subcategories' => ServiceSubcategoryResource::collection($this->whenLoaded('subcategories')),
            'active_subcategories' => ServiceSubcategoryResource::collection($this->whenLoaded('activeSubcategories')),
        ];
    }
}
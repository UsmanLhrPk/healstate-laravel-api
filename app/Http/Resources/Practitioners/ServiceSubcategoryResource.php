<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceSubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'display_order' => $this->display_order,
            'is_active' => $this->is_active,
            'category' => new ServiceCategoryResource($this->whenLoaded('category')),
        ];
    }
}
<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = $this->route('product');
        return $product && $product->vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'brief' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:10000',
            'type' => 'sometimes|required|in:product,service',
            'active' => 'sometimes|boolean',
            
            // Image validation
            'images' => 'sometimes|array|max:5',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            
            // Variants
            'variants' => 'sometimes|array',
            'variants.*.id' => 'sometimes|exists:product_variants,id',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'sometimes|integer|min:0',
            
            // Slots
            'slots' => 'sometimes|array',
            'slots.*.id' => 'sometimes|exists:service_slots,id',
            'slots.*.duration' => 'required|integer|min:1',
            'slots.*.price' => 'required|numeric|min:0',
        ];
    }
}
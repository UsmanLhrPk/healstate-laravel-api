<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $vendor = $this->route('vendor');
        return $vendor && $vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'brief' => 'required|string|max:255',
            'description' => 'required|string|max:10000', // Increased for HTML content
            'type' => 'required|in:product,service',
            'active' => 'sometimes|boolean',
            
            // Image validation
            'images' => 'sometimes|array|max:5',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120', // 5MB max per image
            
            // Variants (for products)
            'variants' => 'required_if:type,product|array',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'sometimes|integer|min:0',
            
            // Slots (for services)
            'slots' => 'required_if:type,service|array',
            'slots.*.duration' => 'required|integer|min:1',
            'slots.*.price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'variants.required_if' => 'At least one variant is required for products',
            'slots.required_if' => 'At least one service slot is required for services',
            'images.max' => 'You can upload a maximum of 5 images',
            'images.*.max' => 'Each image must be less than 5MB',
        ];
    }
}
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
            'title'            => 'required|string|max:255',
            'brief'            => 'required|string|max:255',
            'description'      => 'required|string|max:10000',
            'active'           => 'sometimes|boolean',
            'images'           => 'sometimes|array|max:5',
            'images.*'         => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'variants'         => 'required|array|min:1',
            'variants.*.name'  => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'sometimes|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'variants.required' => 'At least one variant is required',
            'images.max'        => 'You can upload a maximum of 5 images',
            'images.*.max'      => 'Each image must be less than 5MB',
        ];
    }
}

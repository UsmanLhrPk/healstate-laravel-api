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
            'description' => 'sometimes|required|string|max:4000',
            'type' => 'sometimes|required|in:product,service',
            'active' => 'sometimes|boolean',
        ];
    }
}
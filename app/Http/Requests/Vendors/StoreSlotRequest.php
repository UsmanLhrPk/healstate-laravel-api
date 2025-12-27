<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = $this->route('product');
        return $product && $product->vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }
}
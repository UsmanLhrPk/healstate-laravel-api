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
            'description' => 'required|string|max:4000',
            'type' => 'required|in:product,service',
            'active' => 'sometimes|boolean',
        ];
    }
}
<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MarketplaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', Rule::in(['product', 'service'])],
            'category' => 'nullable|string|max:255',
            'search' => 'nullable|string|max:255',
            'sort' => ['nullable', Rule::in(['latest', 'price_low', 'price_high', 'rating'])],
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:50',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        
        // Set defaults
        $validated['sort'] = $validated['sort'] ?? 'latest';
        $validated['page'] = $validated['page'] ?? 1;
        $validated['per_page'] = $validated['per_page'] ?? 12;
        
        return $validated;
    }
}
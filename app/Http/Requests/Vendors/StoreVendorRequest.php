<?php

namespace App\Http\Requests\Vendors;

use App\Models\Vendor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVendorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'business_name' => 'required|string|max:255',
            'brief' => 'required|string',
            'category' => 'required|array',
            'category.*' => 'required|string',
            'website' => 'nullable|url|max:255',
            'street_address' => 'nullable|string|max:255',
            'city' => 'required_with:street_address|string|max:255',
            'state_province' => 'required_with:street_address|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'currency' => ['required', 'string', Rule::in(array_keys(Vendor::CURRENCIES))],
        ];
    }

    public function messages(): array
    {
        return [
            'currency.required' => 'Please select a currency for your vendor.',
            'currency.in' => 'The selected currency is invalid. Please choose USD, EUR, or GBP.',
        ];
    }
}
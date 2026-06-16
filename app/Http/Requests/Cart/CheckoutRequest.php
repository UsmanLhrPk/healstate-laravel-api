<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('address')) {
        $address = $this->input('address');
        $textFields = ['name', 'street_address', 'city', 'state_province', 'postal_code'];
        foreach ($textFields as $field) {
            if (isset($address[$field])) {
                $address[$field] = strip_tags($address[$field]);
            }
        }
        $this->merge(['address' => $address]);
    }
        if ($this->filled('order_notes')) {
            $this->merge([
                'order_notes' => strip_tags($this->input('order_notes')),
            ]);
        }
    }

    public function rules(): array
    {
        $rules = [
            // Support both old single-payment and new multi-currency formats
            'payment_method_id' => ['required_without:payment_intents', 'string'],
            'payment_intents' => ['required_without:payment_method_id', 'array', 'min:1'],
            'payment_intents.*.payment_method_id' => ['required', 'string'],
            'payment_intents.*.currency' => ['required', 'string', Rule::in(array_keys(\App\Models\Vendor::CURRENCIES))],
            'order_notes' => ['nullable', 'string', 'max:1000'],
        ];

        if (auth()->check()) {
            $rules['address_id'] = ['required', 'integer', 'exists:addresses,id'];
        } else {
            $rules['address'] = ['required', 'array'];
            $rules['address.name'] = ['required', 'string', 'max:255'];
            $rules['address.phone'] = ['required', 'string', 'min:10', 'max:20'];
            $rules['address.email'] = ['required', 'email', 'max:255'];
            $rules['address.street_address'] = ['required', 'string', 'max:500'];
            $rules['address.city'] = ['required', 'string', 'max:255'];
            $rules['address.state_province'] = ['required', 'string', 'max:255'];
            $rules['address.postal_code'] = ['required', 'string', 'max:20'];
            $rules['address.country'] = ['nullable', 'string', 'max:2'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'Please select a shipping address.',
            'address.required' => 'Shipping address is required.',
            'payment_method_id.required_without' => 'Payment method is required.',
            'payment_intents.required_without' => 'Payment information is required.',
            'payment_intents.*.payment_method_id.required' => 'Payment method is required for each currency.',
            'payment_intents.*.currency.required' => 'Currency is required for each payment.',
            'payment_intents.*.currency.size' => 'Currency must be a 3-letter code (e.g., USD, EUR).',
        ];
    }
}

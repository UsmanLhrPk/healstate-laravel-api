<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            // Support both old single-payment and new multi-currency formats
            'payment_method_id' => ['required_without:payment_intents', 'string'],
            'payment_intents' => ['required_without:payment_method_id', 'array', 'min:1'],
            'payment_intents.*.payment_method_id' => ['required', 'string'],
            'payment_intents.*.currency' => ['required', 'string', 'size:3'],
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
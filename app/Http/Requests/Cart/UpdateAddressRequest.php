<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if the authenticated user owns this address
        return $this->address && $this->address->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:20'],
            'email' => ['sometimes', 'email', 'max:255'],
            'street_address' => ['sometimes', 'string', 'max:500'],
            'city' => ['sometimes', 'string', 'max:255'],
            'state_province' => ['sometimes', 'string', 'max:255'],
            'postal_code' => ['sometimes', 'string', 'max:20'],
            'country' => ['sometimes', 'string', 'size:2'], // ISO 2-letter country code
            'is_default' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot exceed 255 characters.',
            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number cannot exceed 20 characters.',
            'email.email' => 'Please provide a valid email address.',
            'street_address.max' => 'The street address cannot exceed 500 characters.',
            'country.size' => 'The country code must be exactly 2 characters.',
            'is_default.boolean' => 'The default flag must be true or false.',
        ];
    }
}
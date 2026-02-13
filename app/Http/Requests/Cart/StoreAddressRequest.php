<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'street_address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:255'],
            'state_province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:2'],
            'is_default' => ['nullable', 'boolean'],
        ];
    }
}

class UpdateAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('address')->user_id;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'min:10', 'max:20'],
            'email' => ['sometimes', 'email', 'max:255'],
            'street_address' => ['sometimes', 'string', 'max:500'],
            'city' => ['sometimes', 'string', 'max:255'],
            'state_province' => ['sometimes', 'string', 'max:255'],
            'postal_code' => ['sometimes', 'string', 'max:20'],
            'country' => ['sometimes', 'string', 'max:2'],
            'is_default' => ['sometimes', 'boolean'],
        ];
    }
}
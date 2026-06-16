<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        $cart = $this->route('cart');
        $userId = auth('sanctum')->id();

        // Authenticated users can only update their own cart items
        if ($userId) {
            return $cart && $cart->user_id === $userId;
        }

        // Guest users validated by session ID
        $sessionId = $this->header('X-Cart-Session-ID')
            ?? $this->cookie('cart_session_id');

        return $cart && $cart->session_id === $sessionId;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Quantity is required.',
            'quantity.integer'  => 'Quantity must be a whole number.',
            'quantity.min'      => 'Quantity must be at least 1.',
            'quantity.max'      => 'Quantity cannot exceed 99.',
        ];
    }
}
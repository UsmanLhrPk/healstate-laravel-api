<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Product fields
            'product_id' => [
                'required_without:service_slot_id',
                'integer',
                'exists:products,id',
            ],
            'variant_id' => [
                'nullable',
                'integer',
                'exists:product_variants,id',
                // Variant is required only when adding a product (not a service)
                Rule::requiredIf(function () {
                    return $this->filled('product_id') && !$this->filled('service_slot_id');
                }),
            ],
            
            // Service fields
            'service_slot_id' => [
                'required_without:product_id',
                'integer',
                'exists:service_slots,id',
            ],
            'booking_date' => [
                'required_if:service_slot_id,*',
                'date',
                'after_or_equal:today',
            ],
            'start_time' => [
                'required_if:service_slot_id,*',
                'date_format:H:i:s',
            ],
            'end_time' => [
                'required_if:service_slot_id,*',
                'date_format:H:i:s',
                'after:start_time',
            ],
            
            // Quantity
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    // Services should always have quantity 1
                    if ($this->filled('service_slot_id') && $value != 1) {
                        $fail('Services can only have quantity of 1.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required_without' => 'Either product_id or service_slot_id is required.',
            'service_slot_id.required_without' => 'Either product_id or service_slot_id is required.',
            'variant_id.required_if' => 'Variant ID is required when adding a product.',
            'booking_date.required_if' => 'Booking date is required for services.',
            'start_time.required_if' => 'Start time is required for services.',
            'end_time.required_if' => 'End time is required for services.',
            'end_time.after' => 'End time must be after start time.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Force quantity to 1 for services
        if ($this->filled('service_slot_id')) {
            $this->merge([
                'quantity' => 1,
            ]);
        }
    }
}

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ];
    }
}
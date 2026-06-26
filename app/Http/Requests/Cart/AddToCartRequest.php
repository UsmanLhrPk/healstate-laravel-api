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
        $isBooking = $this->filled('practitioner_offering_slot_id') || $this->filled('service_slot_id');
        $isCourse  = $this->filled('course_id');
        $isProduct = !$isBooking && !$isCourse; // fallback to physical product

        return [
            // ── Physical product ──────────────────────────────────────────
            'product_id' => [
                Rule::requiredIf($isProduct),    // ← required only when no course/slot given
                'nullable',
                'integer',
                'exists:products,id',
                Rule::prohibitedIf($isBooking || $isCourse), // cannot mix with other types
            ],
            'variant_id' => [
                'nullable',
                'integer',
                'exists:product_variants,id',
            ],

            // ── Course ────────────────────────────────────────────────────
            'course_id' => [
                Rule::requiredIf($isCourse),
                'nullable',
                'integer',
                'exists:courses,id',
                Rule::prohibitedIf($isBooking || $isProduct), // unique type
            ],

            // ── Practitioner / service slots ─────────────────────────────
            'practitioner_offering_slot_id' => [
                'nullable',
                'integer',
                'exists:practitioner_offering_slots,id',
                Rule::prohibitedIf($this->filled('service_slot_id') || $isProduct || $isCourse),
            ],
            'service_slot_id' => [
                'nullable',
                'integer',
                'exists:service_slots,id',
                Rule::prohibitedIf($this->filled('practitioner_offering_slot_id') || $isProduct || $isCourse),
            ],

            // ── Shared booking fields ─────────────────────────────────────
            'booking_date' => [
                Rule::requiredIf($isBooking),
                'nullable',
                'date',
                'after_or_equal:today',
            ],
            'start_time' => [
                Rule::requiredIf($isBooking),
                'nullable',
                'regex:/^\d{1,2}:\d{2}(:\d{2})?$/',
            ],
            'end_time' => [
                Rule::requiredIf($isBooking),
                'nullable',
                'regex:/^\d{1,2}:\d{2}(:\d{2})?$/',
            ],

            // ── Quantity ──────────────────────────────────────────────────
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:99',
                function ($attribute, $value, $fail) use ($isBooking) {
                    if ($isBooking && $value != 1) {
                        $fail('Bookings can only have a quantity of 1.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'                           => 'A product, course, or slot ID is required.',
            'course_id.required'                            => 'A course_id is required.',
            'course_id.exists'                              => 'The selected course does not exist.',
            'product_id.prohibited'                         => 'Cannot mix product_id with a course or booking.',
            'course_id.prohibited'                          => 'Cannot mix course_id with a product or booking.',
            'practitioner_offering_slot_id.prohibited'     => 'Cannot send both slot types or mix with a product/course.',
            'service_slot_id.prohibited'                   => 'Cannot send both slot types or mix with a product/course.',
            'booking_date.required'                        => 'Booking date is required for service bookings.',
            'start_time.required'                          => 'Start time is required for service bookings.',
            'start_time.regex'                             => 'Start time must be in H:i or H:i:s format.',
            'end_time.required'                            => 'End time is required for service bookings.',
            'end_time.regex'                               => 'End time must be in H:i or H:i:s format.',
        ];
    }

    /**
     * Normalise times and force quantity for bookings.
     */
    protected function prepareForValidation(): void
    {
        $patch = [];

        foreach (['start_time', 'end_time'] as $field) {
            if ($this->filled($field)) {
                $time = $this->input($field);
                if (preg_match('/^\d{1,2}:\d{2}$/', $time)) {
                    $patch[$field] = $time . ':00';
                }
            }
        }

        // Bookings are always quantity 1
        if ($this->filled('practitioner_offering_slot_id') || $this->filled('service_slot_id')) {
            $patch['quantity'] = 1;
        }

        if (! empty($patch)) {
            $this->merge($patch);
        }
    }
}
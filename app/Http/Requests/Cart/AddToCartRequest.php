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
        $isPractitionerBooking = $this->filled('practitioner_offering_slot_id');
        $isLegacyService       = $this->filled('service_slot_id');
        $isBooking             = $isPractitionerBooking || $isLegacyService;

        return [
            // ── Physical product fields ───────────────────────────────────
            'product_id' => [
                Rule::requiredIf(! $isBooking),
                'nullable',
                'integer',
                'exists:products,id',
            ],
            'variant_id' => [
                'nullable',
                'integer',
                'exists:product_variants,id',
            ],

            // ── Healer / practitioner slot (new) ──────────────────────────
            'practitioner_offering_slot_id' => [
                'nullable',
                'integer',
                'exists:practitioner_offering_slots,id',
                // Must not be sent alongside the legacy service_slot_id
                Rule::prohibitedIf($isLegacyService),
            ],

            // ── Legacy vendor service slot (kept for backward compat) ─────
            'service_slot_id' => [
                'nullable',
                'integer',
                'exists:service_slots,id',
                Rule::prohibitedIf($isPractitionerBooking),
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
                // Accept both "H:i" (frontend) and "H:i:s" (legacy) formats
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
            'product_id.required'                          => 'A product_id or slot ID is required.',
            'practitioner_offering_slot_id.prohibited'     => 'Cannot send both practitioner_offering_slot_id and service_slot_id.',
            'service_slot_id.prohibited'                   => 'Cannot send both practitioner_offering_slot_id and service_slot_id.',
            'booking_date.required'                        => 'Booking date is required for service bookings.',
            'start_time.required'                          => 'Start time is required for service bookings.',
            'start_time.regex'                             => 'Start time must be in H:i or H:i:s format (e.g. 10:00 or 10:00:00).',
            'end_time.required'                            => 'End time is required for service bookings.',
            'end_time.regex'                               => 'End time must be in H:i or H:i:s format (e.g. 11:00 or 11:00:00).',
        ];
    }

    /**
     * Normalise times to H:i:s before validation so the DB time column
     * always receives a consistent format, and force quantity = 1 for bookings.
     */
    protected function prepareForValidation(): void
    {
        $patch = [];

        // Normalise "10:00" → "10:00:00" for DB storage
        foreach (['start_time', 'end_time'] as $field) {
            if ($this->filled($field)) {
                $time = $this->input($field);
                // If only H:i, append seconds
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
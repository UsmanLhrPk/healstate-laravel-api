<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerOfferingBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Require active user session
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'practitioner_offering_slot_id' => 'required|exists:practitioner_offering_slots,id',
            'booking_date'                  => 'required|date|after_or_equal:today',
            'start_time'                    => 'required|date_format:H:i:s',
            'end_time'                      => 'required|date_format:H:i:s|after:start_time',
        ];
    }
}
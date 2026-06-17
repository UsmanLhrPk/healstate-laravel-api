<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerOfferingAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        $slot = $this->route('slot');
        
        // Ensure the slot exists and belongs entirely to the authenticated user's profile
        return $slot && $slot->offering?->practitionerProfile?->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'schedule'                           => 'required|array|min:1|max:7',
            'schedule.*.day_of_week'             => 'required|integer|between:0,6',
            'schedule.*.is_available'            => 'required|boolean',
            'schedule.*.time_slots'              => 'present_if:schedule.*.is_available,true|array|max:10',
            'schedule.*.time_slots.*.start_time' => 'required_with:schedule.*.time_slots|date_format:H:i',
            'schedule.*.time_slots.*.end_time'   => 'required_with:schedule.*.time_slots|date_format:H:i|after:schedule.*.time_slots.*.start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'schedule.*.day_of_week.between'                 => 'Day must be 0 (Sunday) to 6 (Saturday)',
            'schedule.*.time_slots.*.start_time.date_format' => 'Start time must be HH:MM format',
            'schedule.*.time_slots.*.end_time.after'         => 'End time must be strictly after the start time',
        ];
    }
}
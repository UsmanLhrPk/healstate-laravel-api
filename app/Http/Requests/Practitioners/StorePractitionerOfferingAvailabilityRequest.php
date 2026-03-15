<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerOfferingAvailabilityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'schedule'                           => 'required|array|min:1',
            'schedule.*.day_of_week'             => 'required|integer|between:0,6',
            'schedule.*.is_available'            => 'required|boolean',
            'schedule.*.time_slots'              => 'array',
            'schedule.*.time_slots.*.start_time' => 'required|date_format:H:i',
            'schedule.*.time_slots.*.end_time'   => 'required|date_format:H:i|after:schedule.*.time_slots.*.start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'schedule.*.day_of_week.between'                 => 'Day must be 0 (Sunday) to 6 (Saturday)',
            'schedule.*.time_slots.*.start_time.date_format' => 'Start time must be HH:MM',
            'schedule.*.time_slots.*.end_time.after'         => 'End time must be after start time',
        ];
    }
}

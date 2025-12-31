<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization handled in controller
    }

    public function rules(): array
    {
        return [
            'schedule' => 'required|array|min:1',
            'schedule.*.day_of_week' => 'required|integer|between:0,6',
            'schedule.*.is_available' => 'required|boolean',
            'schedule.*.time_slots' => 'array',
            'schedule.*.time_slots.*.start_time' => 'required|date_format:H:i',
            'schedule.*.time_slots.*.end_time' => 'required|date_format:H:i|after:schedule.*.time_slots.*.start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'schedule.required' => 'Schedule data is required',
            'schedule.*.day_of_week.required' => 'Day of week is required',
            'schedule.*.day_of_week.between' => 'Day of week must be between 0 (Sunday) and 6 (Saturday)',
            'schedule.*.time_slots.*.start_time.required' => 'Start time is required',
            'schedule.*.time_slots.*.start_time.date_format' => 'Start time must be in HH:MM format',
            'schedule.*.time_slots.*.end_time.required' => 'End time is required',
            'schedule.*.time_slots.*.end_time.after' => 'End time must be after start time',
        ];
    }
}
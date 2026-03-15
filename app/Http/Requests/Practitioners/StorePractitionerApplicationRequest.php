<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && ! auth()->user()->hasPendingPractitionerApplication();
    }

    public function rules(): array
    {
        return [
            // Personal/Professional Information
            'phone_number'       => ['required', 'string', 'max:20'],
            'professional_title' => ['required', 'string', 'max:255'],
            'years_experience'   => ['required', 'in:0-1,1-3,3-5,5-10,10+,15+,20+,25+,30+'],
            'bio'                => ['required', 'string', 'max:500'],

            // Credentials
            'credentials'                          => ['required', 'array', 'min:1', 'max:5'],
            'credentials.*.file'                   => [
                'required', 'file', 'min:1', 'max:5120',
                function ($attribute, $value, $fail) {
                    if ($value->getSize() === 0) {
                        $fail('The uploaded file cannot be empty.');
                    }
                    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
                    if (! in_array(strtolower($value->getClientOriginalExtension()), $allowed)) {
                        $fail('Credentials must be PDF or image files (JPG, PNG).');
                    }
                },
            ],
            'credentials.*.license_number'       => ['required', 'string', 'max:100'],
            'credentials.*.issuing_organization' => ['required', 'string', 'max:255'],

            // Service Configuration
            'primary_category_id'  => ['required', 'integer', 'exists:service_categories,id'],
            'selected_services'    => ['required', 'array', 'min:1'],
            'selected_services.*'  => ['integer', 'exists:service_subcategories,id'],
            'service_description'  => ['required', 'string', 'max:1000'],

            // Availability
            'availability_schedule'                                          => ['required', 'array'],
            'availability_schedule.schedule_type'                            => ['required', 'in:date_range,weekly'],
            'availability_schedule.start_date'                               => [
                'nullable', 'date',
                'required_if:availability_schedule.schedule_type,date_range',
            ],
            'availability_schedule.end_date'                                 => [
                'nullable', 'date',
                'required_if:availability_schedule.schedule_type,date_range',
                'after_or_equal:availability_schedule.start_date',
            ],
            'availability_schedule.days'                                     => ['required', 'array'],
            'availability_schedule.days.*.is_available'                      => ['boolean'],
            'availability_schedule.days.*.slot_duration_minutes'             => ['required', 'integer', 'in:15,30,45,60,90,120'],
            'availability_schedule.days.*.time_slots'                        => ['array'],
            'availability_schedule.days.*.time_slots.*.start_time'           => ['string', 'regex:/^\d{2}:\d{2}$/'],
            'availability_schedule.days.*.time_slots.*.end_time'             => ['string', 'regex:/^\d{2}:\d{2}$/'],

            // Timezone & Terms
            'timezone'     => ['required', 'string', 'timezone'],
            'terms_agreed' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required'                                  => 'Phone number is required.',
            'professional_title.required'                            => 'Professional title is required.',
            'bio.max'                                                => 'Bio cannot exceed 500 characters.',
            'credentials.required'                                   => 'At least one credential document is required.',
            'credentials.max'                                        => 'You can upload a maximum of 5 credentials.',
            'credentials.*.file.max'                                 => 'Each credential file cannot exceed 5MB.',
            'credentials.*.file.min'                                 => 'Each credential file cannot be empty.',
            'credentials.*.license_number.required'                  => 'License number is required for each credential.',
            'credentials.*.issuing_organization.required'            => 'Issuing organization is required for each credential.',
            'primary_category_id.required'                           => 'Please select a primary service category.',
            'selected_services.required'                             => 'Please select at least one specific service.',
            'selected_services.*.exists'                             => 'One or more selected services are invalid.',
            'service_description.required'                           => 'Service description is required.',
            'service_description.max'                                => 'Service description cannot exceed 1000 characters.',
            'availability_schedule.required'                         => 'Availability schedule is required.',
            'availability_schedule.schedule_type.required'           => 'Schedule type is required.',
            'availability_schedule.schedule_type.in'                 => 'Schedule type must be date_range or weekly.',
            'availability_schedule.start_date.required_if'          => 'Start date is required for date range schedules.',
            'availability_schedule.end_date.required_if'            => 'End date is required for date range schedules.',
            'availability_schedule.end_date.after_or_equal'         => 'End date must be on or after start date.',
            'availability_schedule.days.required'                    => 'Please configure at least one day.',
            'availability_schedule.days.*.slot_duration_minutes.required' => 'Slot duration is required for each day.',
            'availability_schedule.days.*.slot_duration_minutes.in'       => 'Slot duration must be 15, 30, 45, 60, 90, or 120 minutes.',
            'availability_schedule.days.*.time_slots.*.start_time.regex'  => 'Time slot start must be in HH:MM format.',
            'availability_schedule.days.*.time_slots.*.end_time.regex'    => 'Time slot end must be in HH:MM format.',
            'timezone.required'                                      => 'Timezone is required.',
            'timezone.timezone'                                      => 'Please provide a valid timezone.',
            'terms_agreed.accepted'                                  => 'You must agree to the Terms of Service.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        // Decode availability_schedule JSON string → array
        if ($this->has('availability_schedule') && is_string($this->availability_schedule)) {
            $data['availability_schedule'] = json_decode($this->availability_schedule, true) ?? [];
        }

        // Decode selected_services JSON string → array
        if ($this->has('selected_services') && is_string($this->selected_services)) {
            $data['selected_services'] = json_decode($this->selected_services, true) ?? [];
        }

        if (! empty($data)) {
            $this->merge($data);
        }

        // Cast is_available booleans and slot_duration_minutes integers in days
        if ($this->has('availability_schedule') && is_array($this->availability_schedule)) {
            $schedule = $this->availability_schedule;
            if (isset($schedule['days']) && is_array($schedule['days'])) {
                foreach ($schedule['days'] as $day => $dayData) {
                    if (isset($dayData['is_available'])) {
                        $schedule['days'][$day]['is_available'] = filter_var(
                            $dayData['is_available'],
                            FILTER_VALIDATE_BOOLEAN
                        );
                    }
                    if (isset($dayData['slot_duration_minutes'])) {
                        $schedule['days'][$day]['slot_duration_minutes'] = (int) $dayData['slot_duration_minutes'];
                    }
                }
            }
            $this->merge(['availability_schedule' => $schedule]);
        }
    }
}
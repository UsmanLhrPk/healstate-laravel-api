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
            'phone_number' => ['required', 'string', 'max:20'],
            'professional_title' => ['required', 'string', 'max:255'],
            'years_experience' => ['required', 'in:0-1,1-3,3-5,5-10,10+,15+,20+,25+,30+'],
            'bio' => ['required', 'string', 'max:500'],

            // Credentials
            'credentials' => ['required', 'array', 'min:1', 'max:5'],
            'credentials.*.file' => [
                'required',
                'file',
                'min:1',
                'max:5120',
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
            'credentials.*.license_number' => ['required', 'string', 'max:100'],
            'credentials.*.issuing_organization' => ['required', 'string', 'max:255'],

            // Service Configuration
            'primary_category_id' => ['required', 'integer', 'exists:service_categories,id'],
            'selected_services' => ['required', 'array', 'min:1'],
            'selected_services.*' => ['integer', 'exists:service_subcategories,id'],
            'service_description' => ['required', 'string', 'max:1000'],

            // Availability
            'availability_schedule' => ['required', 'array'],
            'availability_schedule.*.morning' => ['boolean'],
            'availability_schedule.*.afternoon' => ['boolean'],
            'availability_schedule.*.evening' => ['boolean'],
            'timezone' => ['required', 'string', 'timezone'],

            // Agreement
            'terms_agreed' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required' => 'Phone number is required.',
            'professional_title.required' => 'Professional title is required.',
            'bio.max' => 'Bio cannot exceed 500 characters.',
            'credentials.required' => 'At least one credential document is required.',
            'credentials.max' => 'You can upload a maximum of 5 credentials.',
            'credentials.*.file.max' => 'Each credential file cannot exceed 5MB.',
            'credentials.*.license_number.required' => 'License number is required for each credential.',
            'credentials.*.issuing_organization.required' => 'Issuing organization is required for each credential.',
            'primary_category_id.required' => 'Please select a primary service category.',
            'selected_services.required' => 'Please select at least one specific service.',
            'selected_services.*.exists' => 'One or more selected services are invalid.',
            'service_description.required' => 'Service description is required.',
            'service_description.max' => 'Service description cannot exceed 1000 characters.',
            'availability_schedule.required' => 'Please select at least one availability slot.',
            'timezone.required' => 'Timezone is required.',
            'timezone.timezone' => 'Please provide a valid timezone.',
            'terms_agreed.accepted' => 'You must agree to the Terms of Service.',
            'credentials.*.file.min' => 'Each credential file cannot be empty.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        // Decode availability_schedule JSON string → array BEFORE foreach
        if ($this->has('availability_schedule') && is_string($this->availability_schedule)) {
            $data['availability_schedule'] = json_decode($this->availability_schedule, true) ?? [];
        }

        // Decode selected_services JSON string → array
        if ($this->has('selected_services') && is_string($this->selected_services)) {
            $data['selected_services'] = json_decode($this->selected_services, true) ?? [];
        }

        // Merge decoded values first so the foreach below works
        if (! empty($data)) {
            $this->merge($data);
        }

        // NOW safe to iterate — schedule is guaranteed to be an array
        if ($this->has('availability_schedule') && is_array($this->availability_schedule)) {
            $schedule = $this->availability_schedule;

            foreach ($schedule as $day => $slots) {
                foreach ($slots as $slot => $value) {
                    $schedule[$day][$slot] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                }
            }

            $this->merge(['availability_schedule' => $schedule]);
        }
    }
}

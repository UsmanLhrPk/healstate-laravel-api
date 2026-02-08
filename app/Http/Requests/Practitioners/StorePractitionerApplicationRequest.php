<?php

namespace App\Http\Requests\Practitioners;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // User must be authenticated and not already have a pending application
        return auth()->check() && !auth()->user()->hasPendingPractitionerApplication();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Personal/Professional Information
            'phone_number' => ['required', 'string', 'max:20'],
            'professional_title' => ['required', 'string', 'max:255'],
            'years_experience' => ['required', 'in:0-1,1-3,3-5,5-10,10+,15+,20+,25+,30+'],
            'bio' => ['required', 'string', 'max:500'],
            
            // Credentials
            'license_number' => ['nullable', 'string', 'max:100'],
            'issuing_organization' => ['nullable', 'string', 'max:255'],
            'credentials' => ['required', 'array', 'min:1', 'max:5'],
            'credentials.*.file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // 5MB
            'credentials.*.document_type' => ['required', 'in:certification,license,credential,other'],
            
            // Service Configuration
            'primary_category_id' => ['required', 'integer', 'exists:service_categories,id'],
            'service_subcategories' => ['required', 'array', 'min:1'],
            'service_subcategories.*' => ['integer', 'exists:service_subcategories,id'],
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

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'phone_number.required' => 'Phone number is required.',
            'professional_title.required' => 'Professional title is required.',
            'bio.max' => 'Bio cannot exceed 500 characters.',
            'credentials.required' => 'At least one credential document is required.',
            'credentials.max' => 'You can upload a maximum of 5 credentials.',
            'credentials.*.file.mimes' => 'Credentials must be PDF or image files (JPG, PNG).',
            'credentials.*.file.max' => 'Each credential file cannot exceed 5MB.',
            'primary_category_id.required' => 'Please select a primary service category.',
            'service_subcategories.required' => 'Please select at least one specific service.',
            'service_description.max' => 'Service description cannot exceed 1000 characters.',
            'terms_agreed.accepted' => 'You must agree to the Terms of Service.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Ensure availability_schedule is properly formatted
        if ($this->has('availability_schedule')) {
            $schedule = $this->availability_schedule;
            
            // Convert string booleans to actual booleans
            foreach ($schedule as $day => $slots) {
                foreach ($slots as $slot => $value) {
                    $schedule[$day][$slot] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                }
            }
            
            $this->merge(['availability_schedule' => $schedule]);
        }
    }
}
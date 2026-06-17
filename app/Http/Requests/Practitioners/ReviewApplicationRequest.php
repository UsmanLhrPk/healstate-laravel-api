<?php

namespace App\Http\Requests\Practitioners;

use App\Services\HtmlSanitizerService;
use Illuminate\Foundation\Http\FormRequest;

class ReviewApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Sanitize admin-written text before validation.
     *
     * rejection_reason is sent to the applicant via email notification.
     * admin_notes is stored and displayed in the admin panel.
     * Neither should contain HTML — strip all tags.
     */
    protected function prepareForValidation(): void
    {
        $sanitizer = app(HtmlSanitizerService::class);

        $merge = [];

        if ($this->has('rejection_reason')) {
            $merge['rejection_reason'] = $sanitizer->sanitizePlainText($this->input('rejection_reason'));
        }

        if ($this->has('admin_notes')) {
            $merge['admin_notes'] = $sanitizer->sanitizePlainText($this->input('admin_notes'));
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }

    public function rules(): array
    {
        return [
            'action'           => ['required', 'in:approve,reject'],
            'rejection_reason' => ['required_if:action,reject', 'nullable', 'string', 'max:1000'],
            'admin_notes'      => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'action.required'              => 'Please specify whether to approve or reject the application.',
            'action.in'                    => 'Invalid action. Must be either approve or reject.',
            'rejection_reason.required_if' => 'Rejection reason is required when rejecting an application.',
        ];
    }
}
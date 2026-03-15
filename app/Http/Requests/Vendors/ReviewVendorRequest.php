<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class ReviewVendorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'action' => 'required|in:approve,reject',
            'rejection_reason' => 'required_if:action,reject|nullable|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'action.required' => 'An action (approve or reject) is required.',
            'action.in' => 'Action must be either approve or reject.',
            'rejection_reason.required_if' => 'A rejection reason is required when rejecting a vendor.',
        ];
    }
}
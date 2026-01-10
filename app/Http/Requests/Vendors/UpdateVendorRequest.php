<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('vendor')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'business_name' => 'sometimes|required|string|max:255',
            'brief' => 'sometimes|required|string',
            'category' => 'sometimes|required|array',
            'category.*' => 'string',
            'website' => 'sometimes|nullable|url|max:255',
            'street_address' => 'sometimes|nullable|string|max:255',
            'city' => 'sometimes|required_with:street_address|string|max:255',
            'state_province' => 'sometimes|required_with:street_address|string|max:255',
            'postal_code' => 'sometimes|nullable|string|max:255',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Get all allowed fields
        $allowedFields = [
            'business_name',
            'brief',
            'category',
            'website',
            'street_address',
            'city',
            'state_province',
            'postal_code',
        ];

        // Get all request keys
        $requestKeys = array_keys($this->all());

        // Find invalid fields
        $invalidFields = array_diff($requestKeys, $allowedFields);

        // If there are invalid fields, add validation error
        if (!empty($invalidFields)) {
            $this->merge([
                '_invalid_fields' => $invalidFields
            ]);
        }
    }

    public function messages(): array
    {
        return [
            '_invalid_fields' => 'The following fields are not allowed: ' . implode(', ', $this->input('_invalid_fields', [])),
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->has('_invalid_fields')) {
                $invalidFields = $this->input('_invalid_fields');
                foreach ($invalidFields as $field) {
                    $validator->errors()->add($field, "The {$field} field is not allowed.");
                }
            }
        });
    }
}
<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = $this->route('product');
        return $product && $product->vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'brief' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:4000',
            'type' => 'sometimes|required|in:product,service',
            'active' => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $allowedFields = ['title', 'brief', 'description', 'type', 'active'];
        $requestKeys = array_keys($this->all());
        $invalidFields = array_diff($requestKeys, $allowedFields);

        if (!empty($invalidFields)) {
            $this->merge(['_invalid_fields' => $invalidFields]);
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->has('_invalid_fields')) {
                foreach ($this->input('_invalid_fields') as $field) {
                    $validator->errors()->add($field, "The {$field} field is not allowed.");
                }
            }
        });
    }
}
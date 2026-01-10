<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        $variant = $this->route('variant');
        return $variant && $variant->product->vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|nullable|integer|min:0',
        ];
    }

    protected function prepareForValidation(): void
    {
        $allowedFields = ['name', 'price', 'stock'];
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
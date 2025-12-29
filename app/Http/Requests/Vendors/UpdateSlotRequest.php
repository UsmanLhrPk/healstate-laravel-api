<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        $slot = $this->route('slot');
        return $slot && $slot->product->vendor->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'duration' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ];
    }

    protected function prepareForValidation(): void
    {
        $allowedFields = ['duration', 'price'];
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
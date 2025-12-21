<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class FlagContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'flaggable_type' => ['required', 'string', 'in:App\Models\Forum,App\Models\Comment'],
            'flaggable_id' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'flaggable_type.required' => 'The content type is required.',
            'flaggable_type.in' => 'Invalid content type. Must be a forum or comment.',
            'flaggable_id.required' => 'The content ID is required.',
            'flaggable_id.integer' => 'The content ID must be a valid number.',
        ];
    }
}
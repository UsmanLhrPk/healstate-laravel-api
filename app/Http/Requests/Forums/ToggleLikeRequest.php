<?php

namespace App\Http\Requests\Forums;

use Illuminate\Foundation\Http\FormRequest;

class ToggleLikeRequest extends FormRequest
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
            'likeable_type' => ['required', 'string', 'in:App\Models\Forum,App\Models\Comment'],
            'likeable_id' => ['required', 'integer', 'min:1'],
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
            'likeable_type.required' => 'The content type is required.',
            'likeable_type.in' => 'Invalid content type. Must be a forum or comment.',
            'likeable_id.required' => 'The content ID is required.',
            'likeable_id.integer' => 'The content ID must be a valid number.',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreForumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:400',
            'content' => 'required|string',
            'category' => 'required|in:Mind,Body,Spirit,Biohacking,Frequency Healing,Holistic Health',
            'sub_category' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Forum title is required',
            'title.max' => 'Title cannot exceed 400 characters',
            'content.required' => 'Forum content is required',
            'category.required' => 'Please select a category',
            'category.in' => 'Invalid category selected',
            'sub_category.required' => 'Please select a sub-category',
        ];
    }
}
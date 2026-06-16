<?php

namespace App\Http\Requests\Forums;

use App\Models\Forum;
use Illuminate\Foundation\Http\FormRequest;

class StoreForumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware + controller
    }

    protected function prepareForValidation(): void
    {
        $sanitizer = app(\App\Services\HtmlSanitizerService::class);

        $this->merge([
            'title' => $sanitizer->sanitize($this->input('title')),
            'content' => $sanitizer->sanitize($this->input('content')),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:400',
            'content' => 'required|string|max:50000',
            'category' => 'required|in:Mind,Body,Spirit,Biohacking,Frequency Healing,Holistic Health',
            'sub_category' => 'required|string',
            'forum_type' => 'required|in:'.implode(',', Forum::TYPES),
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
            'forum_type.required' => 'Please select a forum type',
            'forum_type.in' => 'Invalid forum type. Must be general, healer, or vendor',
        ];
    }
}

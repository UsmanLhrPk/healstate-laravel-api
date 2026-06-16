<?php

namespace App\Http\Requests\Forums;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware
    }

    protected function prepareForValidation(): void
    {
        $sanitizer = app(\App\Services\HtmlSanitizerService::class);

        $this->merge([
            'comment' => $sanitizer->sanitize($this->input('comment')),
        ]);
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:5000',
            'commentable_type' => 'required|string|in:App\Models\Forum',
            'commentable_id' => 'required|integer|exists:forums,id',
            'parent_id' => 'nullable|exists:comments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'Comment text is required',
            'commentable_type.required' => 'Commentable type is required',
            'commentable_id.required' => 'Commentable ID is required',
            'parent_id.exists' => 'Parent comment does not exist',
        ];
    }
}

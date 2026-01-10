<?php

namespace App\Http\Requests\Forums;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string',
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
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
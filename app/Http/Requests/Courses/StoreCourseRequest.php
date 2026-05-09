<?php

namespace App\Http\Requests\Courses;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_practitioner === true;
    }

    protected function failedAuthorization(): void
    {
        throw new AuthorizationException(
            'Only verified practitioners may create courses.'
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:250',
            'category_id' => 'required|exists:service_categories,id',
            'description' => 'required|string|max:20000',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'promo_video_url' => 'nullable|url|max:500',
            'difficulty_level' => ['required', 'string', Rule::in(['beginner', 'intermediate', 'advanced', 'all_levels'])],
            'language' => 'nullable|string|max:10',
            'pricing_type' => ['nullable', 'string', Rule::in(['free', 'paid'])],
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'is_featured' => 'sometimes|boolean',
            'status' => ['nullable', 'string', Rule::in([
                Course::STATUS_DRAFT,
                Course::STATUS_PENDING,
                Course::STATUS_PUBLISHED,
                Course::STATUS_REJECTED,
                Course::STATUS_ARCHIVED,
            ])],
            'subcategory_ids' => 'nullable|array',
            'subcategory_ids.*' => 'integer|exists:service_subcategories,id',
            'outcomes' => 'nullable|array|max:100',
            'outcomes.*' => 'required|string|max:200',
            'requirements' => 'nullable|array|max:100',
            'requirements.*' => 'required|string|max:200',
            'modules' => 'nullable|array|max:100',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.description' => 'nullable|string|max:5000',
            'modules.*.lessons' => 'nullable|array|max:200',
            'modules.*.lessons.*.title' => 'required|string|max:255',
            'modules.*.lessons.*.lesson_type' => ['required', 'string', Rule::in(['video', 'text', 'pdf'])],
            'modules.*.lessons.*.video_url' => 'nullable|url|max:2000',
            'modules.*.lessons.*.text_content' => 'nullable|string|max:50000',
            'modules.*.lessons.*.pdf_path' => 'nullable|string|max:500',
            'modules.*.lessons.*.duration_minutes' => 'nullable|integer|min:1',
            'modules.*.lessons.*.is_preview' => 'sometimes|boolean',
        ];
    }
}

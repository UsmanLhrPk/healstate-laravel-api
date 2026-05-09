<?php

namespace App\Http\Requests\Courses;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $course = $this->route('course');

        return $this->user()->can('update', $course);
    }

    public function failedAuthorization(): void
    {
        throw new \Illuminate\Auth\Access\AuthorizationException(
            'Courses that are pending review or published cannot be edited.'
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'subtitle' => 'nullable|string|max:250',
            'category_id' => 'sometimes|exists:service_categories,id',
            'description' => 'sometimes|string|max:20000',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'promo_video_url' => 'nullable|url|max:500',
            'difficulty_level' => ['sometimes', 'string', Rule::in(['beginner', 'intermediate', 'advanced', 'all_levels'])],
            'language' => 'sometimes|string|max:10',
            'pricing_type' => ['sometimes', 'string', Rule::in(['free', 'paid'])],
            'price' => 'sometimes|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'is_featured' => 'sometimes|boolean',
            'status' => ['sometimes', 'string', Rule::in([
                Course::STATUS_DRAFT,
                Course::STATUS_PENDING,
                Course::STATUS_PUBLISHED,
                Course::STATUS_REJECTED,
                Course::STATUS_ARCHIVED,
            ])],
            'subcategory_ids' => 'sometimes|array',
            'subcategory_ids.*' => 'integer|exists:service_subcategories,id',
            'outcomes' => 'sometimes|array|max:100',
            'outcomes.*' => 'required|string|max:200',
            'requirements' => 'sometimes|array|max:100',
            'requirements.*' => 'required|string|max:200',
            'modules' => 'sometimes|array|max:100',
            'modules.*.id' => 'nullable|integer|exists:course_sections,id',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.description' => 'nullable|string|max:5000',
            'modules.*.lessons' => 'nullable|array|max:200',
            'modules.*.lessons.*.id' => 'nullable|integer|exists:course_lessons,id',
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

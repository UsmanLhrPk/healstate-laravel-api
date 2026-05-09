<?php

namespace App\Http\Requests\Courses;

use App\Models\CourseMedia;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadCourseMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ownership enforced in controller / service
    }

    public function rules(): array
    {
        $type = $this->input('media_type');

        return [
            'media_type' => [
                'required',
                Rule::in([
                    CourseMedia::TYPE_THUMBNAIL,
                    CourseMedia::TYPE_PROMO_VIDEO,
                    CourseMedia::TYPE_LESSON_VIDEO,
                    CourseMedia::TYPE_LESSON_PDF,
                    CourseMedia::TYPE_ATTACHMENT,
                ]),
            ],
            'file' => [
                'required',
                'file',
                ...$this->fileRules($type),
            ],
        ];
    }

    private function fileRules(?string $type): array
    {
        return match ($type) {
            CourseMedia::TYPE_THUMBNAIL => [
                'mimes:jpg,jpeg,png,webp',
                'max:2048',                    // 2 MB
            ],
            CourseMedia::TYPE_PROMO_VIDEO,
            CourseMedia::TYPE_LESSON_VIDEO => [
                'mimes:mp4,mov,avi,mkv,webm',
                'max:524288',                  // 512 MB
            ],
            CourseMedia::TYPE_LESSON_PDF => [
                'mimes:pdf',
                'max:51200',                   // 50 MB
            ],
            CourseMedia::TYPE_ATTACHMENT => [
                'max:10240',                   // 10 MB
            ],
            default => [],
        };
    }

    public function messages(): array
    {
        return [
            'file.max' => 'The file exceeds the maximum allowed size for this media type.',
        ];
    }
}
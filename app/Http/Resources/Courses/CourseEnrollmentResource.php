<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseEnrollmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'user_id' => $this->user_id,
            'enrollment_type' => $this->enrollment_type,
            'amount_paid' => $this->amount_paid !== null ? (float) $this->amount_paid : null,
            'payment_reference' => $this->payment_reference,
            'progress_percent' => (float) $this->progress_percent,
            'is_completed' => (bool) $this->is_completed,
            'completed_lessons_count' => $this->whenLoaded('lessonProgress', fn () => $this->lessonProgress->where('is_completed', true)->count()),
            'total_lessons_count' => $this->whenLoaded('course', fn () => $this->course->modules->sum(fn ($module) => $module->lessons->count())),
            'enrolled_at' => $this->enrolled_at,
            'last_accessed_at' => $this->last_accessed_at,
            'completed_at' => $this->completed_at,
            'course' => $this->whenLoaded('course', function () {
                return [
                    'id' => $this->course->id,
                    'title' => $this->course->title,
                    'slug' => $this->course->slug,
                    'subtitle' => $this->course->subtitle,
                    'thumbnail_url' => $this->course->thumbnail_url,
                ];
            }),
        ];
    }
}

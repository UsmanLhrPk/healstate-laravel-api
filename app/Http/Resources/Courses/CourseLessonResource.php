<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseLessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'section_id' => $this->section_id,
            'course_id' => $this->course_id,
            'title' => $this->title,
            'can_access' => (bool) ($this->can_access ?? $this->is_preview),
            'is_locked' => (bool) ($this->is_locked ?? false),
            'is_completed' => (bool) ($this->is_completed ?? false),
            'completed_at' => $this->completed_at ?? null,
            'lesson_type' => $this->lesson_type,
            'text_content' => $this->text_content,
            'video_path' => $this->video_path,
            'video_url' => $this->video_url,
            'pdf_path' => $this->pdf_path,
            'duration_minutes' => $this->duration_minutes,
            'is_preview' => $this->is_preview,
            'display_order' => $this->display_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

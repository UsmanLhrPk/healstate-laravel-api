<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseMediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'media_type'       => $this->media_type,
            'file_name'        => $this->file_name,
            'file_size'        => $this->file_size,
            'file_size_human'  => $this->file_size_human,
            'mime_type'        => $this->mime_type,
            'duration_seconds' => $this->duration_seconds,
            'url'              => $this->url,
            'uploaded_at'      => $this->uploaded_at?->toISOString(),

            'lesson_id' => $this->lesson_id,

            'uploader' => $this->whenLoaded('uploader', fn () => [
                'id'   => $this->uploader->id,
                'name' => $this->uploader->name,
            ]),
        ];
    }
}
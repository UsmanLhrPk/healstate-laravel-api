<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'title'                  => $this->title,
            'slug'                   => $this->slug,
            'status'                 => $this->status,
            'is_featured'            => $this->is_featured,
            'pricing_type'           => $this->pricing_type,
            'price'                  => $this->price,
            'difficulty_level'       => $this->difficulty_level,
            'total_enrollments'      => $this->total_enrollments,
            'average_rating'         => $this->average_rating,
            'total_reviews'          => $this->total_reviews,
            'total_duration_minutes' => $this->total_duration_minutes,
            'modules_count'          => $this->modules_count ?? 0,
            'rejection_reason'       => $this->rejection_reason,
            'admin_notes'            => $this->admin_notes,
            'submitted_at'           => $this->submitted_at?->toISOString(),
            'published_at'           => $this->published_at?->toISOString(),
            'reviewed_at'            => $this->reviewed_at?->toISOString(),
            'created_at'             => $this->created_at?->toISOString(),

            'author' => $this->whenLoaded('author', fn () => [
                'id'    => $this->author->id,
                'name'  => $this->author->name,
                'email' => $this->author->email,
            ]),

            'category' => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ]),

            'reviewer' => $this->whenLoaded('reviewer', fn () => $this->reviewer ? [
                'id'   => $this->reviewer->id,
                'name' => $this->reviewer->name,
            ] : null),
        ];
    }
}
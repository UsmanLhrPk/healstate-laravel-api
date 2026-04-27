<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $enrollment = $this->whenLoaded('enrollments', function () {
            return $this->enrollments->first();
        });

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'thumbnail_url' => $this->thumbnail_url,
            'promo_video_url' => $this->promo_video_url,
            'difficulty_level' => $this->difficulty_level,
            'language' => $this->language,
            'pricing_type' => $this->pricing_type,
            'price' => (float) $this->price,
            'discount_price' => $this->discount_price !== null ? (float) $this->discount_price : null,
            'is_featured' => $this->is_featured,
            'status' => $this->status,
            'submitted_at' => $this->submitted_at,
            'published_at' => $this->published_at,
            'author' => $this->whenLoaded('author', fn () => [
                'id' => $this->author->id,
                'name' => $this->author->name,
                'email' => $this->author->email,
            ]),
            'category' => $this->whenLoaded('category'),
            'subcategories' => $this->whenLoaded('subcategories'),
            'outcomes' => $this->whenLoaded('outcomes', fn () => $this->outcomes->map(fn ($item) => [
                'id' => $item->id,
                'text' => $item->outcome_text,
                'display_order' => $item->display_order,
            ])->values()),
            'requirements' => $this->whenLoaded('requirements', fn () => $this->requirements->map(fn ($item) => [
                'id' => $item->id,
                'text' => $item->requirement_text,
                'display_order' => $item->display_order,
            ])->values()),
            'modules' => CourseModuleResource::collection($this->whenLoaded('modules')),
            'statistics' => [
                'modules_count' => $this->whenCounted('modules'),
                'lessons_count' => $this->lessons_count ?? null,
                'enrollments_count' => $this->enrollments_count ?? null,
                'total_duration_minutes' => $this->total_duration_minutes,
                'average_rating' => $this->average_rating !== null ? (float) $this->average_rating : null,
                'total_reviews' => $this->total_reviews,
            ],
            'my_enrollment' => $enrollment ? new CourseEnrollmentResource($enrollment) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

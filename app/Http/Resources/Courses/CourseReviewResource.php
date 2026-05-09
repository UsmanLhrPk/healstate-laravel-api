<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'rating'      => $this->rating,
            'review_text' => $this->review_text,
            'created_at'  => $this->created_at?->toISOString(),
            'updated_at'  => $this->updated_at?->toISOString(),

            'reviewer' => [
                'id'     => $this->user->id,
                'name'   => $this->user->name,
                'avatar' => $this->user->avatar_url ?? null,
            ],

            // Only exposed to the review owner
            'can_resubmit' => $this->when(
                $request->user()?->id === $this->user_id,
                $this->deletion_count === 0
            ),
        ];
    }
}
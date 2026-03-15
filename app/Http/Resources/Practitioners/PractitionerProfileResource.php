<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PractitionerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->when(auth('admin')->check(), $this->user->email),
            ],
            'phone_number' => $this->phone_number,
            'professional_title' => $this->professional_title,
            'years_experience' => $this->years_experience,
            'bio' => $this->bio,
            'license_number' => $this->license_number,
            'issuing_organization' => $this->issuing_organization,
            'primary_category' => new ServiceCategoryResource($this->whenLoaded('primaryCategory')),
            'services' => ServiceSubcategoryResource::collection($this->whenLoaded('services')),
            'service_description' => $this->service_description,
            'availability_schedule' => $this->availability_schedule,
            'timezone' => $this->timezone,
            'is_active' => $this->is_active,
            'is_accepting_clients' => $this->is_accepting_clients,
            'profile_image_path' => $this->profile_image_path,
            'profile_image_url' => $this->profile_image_path ? asset('storage/' . $this->profile_image_path) : null,
            'statistics' => [
                'total_bookings' => $this->total_bookings,
                'average_rating' => $this->average_rating ? (float) $this->average_rating : null,
                'total_reviews' => $this->total_reviews,
            ],
            'approved_at' => $this->approved_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
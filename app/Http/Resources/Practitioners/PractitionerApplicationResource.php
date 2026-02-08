<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PractitionerApplicationResource extends JsonResource
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
                'email' => $this->user->email,
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
            'status' => $this->status,
            'reviewed_by' => $this->reviewed_by,
            'reviewer' => $this->whenLoaded('reviewer', function () {
                return [
                    'id' => $this->reviewer->id,
                    'name' => $this->reviewer->name,
                ];
            }),
            'reviewed_at' => $this->reviewed_at?->toIso8601String(),
            'rejection_reason' => $this->when(
                $request->user()?->is_admin || $this->user_id === $request->user()?->id,
                $this->rejection_reason
            ),
            'admin_notes' => $this->when($request->user()?->is_admin, $this->admin_notes),
            'terms_agreed' => $this->terms_agreed,
            'terms_agreed_at' => $this->terms_agreed_at?->toIso8601String(),
            'documents' => ApplicationDocumentResource::collection($this->whenLoaded('documents')),
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
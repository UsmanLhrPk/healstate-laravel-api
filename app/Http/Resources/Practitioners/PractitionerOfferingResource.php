<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PractitionerOfferingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'practitioner_profile_id' => $this->practitioner_profile_id,
            'subcategory_id'          => $this->subcategory_id,
            'subcategory'             => $this->whenLoaded('subcategory'),
            'title'                   => $this->title,
            'brief'                   => $this->brief,
            'description'             => $this->description,
            'duration'                => $this->duration,
            'price'                   => $this->price,
            'active'                  => $this->active,
            'images'                  => $this->images,
            'slots'                   => PractitionerOfferingSlotResource::collection($this->whenLoaded('slots')),
            'practitioner_profile'    => $this->whenLoaded('practitionerProfile'),
            'created_at'              => $this->created_at,
            'updated_at'              => $this->updated_at,
        ];
    }
}

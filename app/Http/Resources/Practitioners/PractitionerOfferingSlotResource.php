<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PractitionerOfferingSlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                       => $this->id,
            'practitioner_offering_id' => $this->practitioner_offering_id,
            'duration'                 => $this->duration,
            'price'                    => $this->price,
            'availability'             => $this->whenLoaded('availability'),
            'created_at'               => $this->created_at,
            'updated_at'               => $this->updated_at,
        ];
    }
}

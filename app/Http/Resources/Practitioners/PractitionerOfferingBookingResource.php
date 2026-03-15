<?php

namespace App\Http\Resources\Practitioners;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PractitionerOfferingBookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                            => $this->id,
            'practitioner_offering_slot_id' => $this->practitioner_offering_slot_id,
            'user_id'                       => $this->user_id,
            'booking_date'                  => $this->booking_date->format('Y-m-d'),
            'start_time'                    => $this->start_time,
            'end_time'                      => $this->end_time,
            'status'                        => $this->status,
            'slot'                          => new PractitionerOfferingSlotResource($this->whenLoaded('slot')),
            'user'                          => $this->whenLoaded('user'),
            'created_at'                    => $this->created_at,
            'updated_at'                    => $this->updated_at,
        ];
    }
}

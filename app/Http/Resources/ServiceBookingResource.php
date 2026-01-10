<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceBookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service_slot_id' => $this->service_slot_id,
            'user_id' => $this->user_id,
            'booking_date' => $this->booking_date->format('Y-m-d'),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'service_slot' => new ServiceSlotResource($this->whenLoaded('serviceSlot')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvailabilityScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'day_of_week' => $this['day_of_week'],
            'is_available' => $this['is_available'],
            'time_slots' => $this['time_slots'],
        ];
    }
}
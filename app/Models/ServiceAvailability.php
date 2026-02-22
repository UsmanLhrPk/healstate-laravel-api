<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceAvailability extends Model
{
use HasFactory;

protected $table = 'service_availability';

protected $fillable = [
    'service_slot_id',
    'day_of_week',
    'start_time',
    'end_time',
];

protected $casts = [
    'day_of_week' => 'integer',
];

public function serviceSlot(): BelongsTo
{
    return $this->belongsTo(ServiceSlot::class);
}
}
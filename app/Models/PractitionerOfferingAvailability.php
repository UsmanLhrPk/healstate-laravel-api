<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PractitionerOfferingAvailability extends Model
{
    use HasFactory;

    protected $table = 'practitioner_offering_availability';

    protected $fillable = [
        'practitioner_offering_slot_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'day_of_week' => 'integer',
    ];

    public function slot(): BelongsTo
    {
        return $this->belongsTo(PractitionerOfferingSlot::class, 'practitioner_offering_slot_id');
    }
}

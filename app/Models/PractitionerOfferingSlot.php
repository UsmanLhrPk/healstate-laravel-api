<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PractitionerOfferingSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_offering_id',
        'duration',
        'price',
    ];

    protected $casts = [
        'duration' => 'integer',
        'price'    => 'decimal:2',
    ];

    public function offering(): BelongsTo
    {
        return $this->belongsTo(PractitionerOffering::class, 'practitioner_offering_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(PractitionerOfferingBooking::class);
    }

    public function availability(): HasMany
    {
        return $this->hasMany(PractitionerOfferingAvailability::class);
    }
}

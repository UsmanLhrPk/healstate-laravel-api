<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PractitionerOfferingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_offering_slot_id',
        'user_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'cancellation_reason',        // ADD
        'cancellation_requested_at',  // ADD
    ];

    protected $casts = [
        'booking_date' => 'date',
        'cancellation_requested_at' => 'datetime', // ADD
    ];

    public function slot(): BelongsTo
    {
        return $this->belongsTo(PractitionerOfferingSlot::class, 'practitioner_offering_slot_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_slot_id',
        'user_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function serviceSlot(): BelongsTo
    {
        return $this->belongsTo(ServiceSlot::class);
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
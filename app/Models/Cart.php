<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        // Physical products
        'product_id',
        'variant_id',
        // Legacy vendor service slots (kept for backward compat)
        'service_slot_id',
        // Healer / practitioner offering slots
        'practitioner_offering_slot_id',
        // Shared booking fields (used by both slot types)
        'booking_date',
        'start_time',
        'end_time',
        'quantity',
         'course_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'booking_date' => 'date',
        // Store as plain strings so "10:00" round-trips correctly
        // (casting to datetime:H:i:s would prepend today's date)
        'start_time' => 'string',
        'end_time' => 'string',
    ];

    // ── Relations ────────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /** Legacy vendor service slot */
    public function serviceSlot(): BelongsTo
    {
        return $this->belongsTo(ServiceSlot::class);
    }

    /** Healer / practitioner offering slot */
    public function practitionerOfferingSlot(): BelongsTo
    {
        return $this->belongsTo(PractitionerOfferingSlot::class);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /** True when this cart row represents a healer booking */
    public function isPractitionerBooking(): bool
    {
        return ! is_null($this->practitioner_offering_slot_id);
    }

    /** True when this cart row represents a legacy vendor service booking */
    public function isServiceBooking(): bool
    {
        return ! is_null($this->service_slot_id);
    }

    /** True when this cart row represents a physical product */
    public function isProduct(): bool
    {
        return ! is_null($this->product_id);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /** True when this cart row represents a course */
    public function isCourse(): bool
    {
        return ! is_null($this->course_id);
    }
}

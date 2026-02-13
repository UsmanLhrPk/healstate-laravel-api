<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'address_id',
        'subtotal',
        'tax',
        'shipping',
        'total',
        'status',
        'payment_intent_id',
        'order_notes',
        'paid_at',
        'cancellation_requested_at',
        'cancellation_reason',
        'cancelled_by',
        'cancellation_type', // 'immediate' or 'requested'
        'currency',
        'currency_symbol',
        'refund_id',
        'refund_status',
        'refunded_at',
        'refund_amount',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'cancellation_requested_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function serviceBookings(): HasMany
    {
        return $this->hasMany(ServiceBooking::class);
    }

    /**
     * Check if order can be cancelled immediately (within 30 minutes)
     */
    public function canCancelImmediately(): bool
    {
        if (! in_array($this->status, ['pending', 'paid'])) {
            return false;
        }

        $minutesSinceCreation = $this->created_at->diffInMinutes(now());

        return $minutesSinceCreation <= 30;
    }

    /**
     * Check if order can request cancellation
     */
    public function canRequestCancellation(): bool
    {
        return in_array($this->status, ['pending', 'paid', 'processing'])
            && $this->status !== 'cancellation_requested';
    }

    /**
     * Get the vendor IDs associated with this order
     */
    public function getVendorIds(): array
    {
        return $this->items()
            ->with('product.vendor')
            ->get()
            ->pluck('product.vendor_id')
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Get the time remaining for immediate cancellation
     */
    public function getCancellationTimeRemaining(): ?int
    {
        if (! $this->canCancelImmediately()) {
            return null;
        }

        $minutesSinceCreation = $this->created_at->diffInMinutes(now());

        return max(0, 30 - $minutesSinceCreation);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-'.strtoupper(uniqid());
            }
        });
    }
}

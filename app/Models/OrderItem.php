<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'service_slot_id',
        'service_booking_id',
        'product_name',
        'type',
        'quantity',
        'unit_price',
        'subtotal',
        'booking_date', 
        'start_time',
        'end_time',
        'course_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'booking_date' => 'date',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function serviceSlot(): BelongsTo
    {
        return $this->belongsTo(ServiceSlot::class, 'service_slot_id');
    }

    public function serviceBooking(): BelongsTo
    {
        return $this->belongsTo(ServiceBooking::class, 'service_booking_id');
    }

    public function isProduct(): bool
    {
        return $this->type === 'product' || $this->product_id !== null;
    }

    public function isService(): bool
    {
        return $this->type === 'service' || $this->service_slot_id !== null;
    }
}
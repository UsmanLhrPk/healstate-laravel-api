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
        'product_id',
        'variant_id',
        'service_slot_id',
        'booking_date',
        'start_time',
        'end_time',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'booking_date' => 'date',     
        'start_time' => 'datetime:H:i:s', 
        'end_time' => 'datetime:H:i:s',   
    ];

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

    public function serviceSlot(): BelongsTo
    {
        return $this->belongsTo(ServiceSlot::class);
    }
}

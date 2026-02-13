<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'stock',
        'sort',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'sort' => 'integer',
    ];

    // Add appends for currency info
    protected $appends = ['currency', 'currency_symbol'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Currency accessor - inherits from product's vendor
    public function getCurrencyAttribute(): string
    {
        return $this->product->vendor->currency ?? 'USD';
    }

    // Currency symbol accessor
    public function getCurrencySymbolAttribute(): string
    {
        return $this->product->vendor->getCurrencySymbol() ?? '$';
    }

    // Helper method to format price
    public function getFormattedPriceAttribute(): string
    {
        return $this->product->vendor->formatPrice((float) $this->price);
    }
}
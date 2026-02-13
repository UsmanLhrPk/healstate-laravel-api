<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'title',
        'brief',
        'description',
        'type',
        'active',
        'images',
    ];

    protected $casts = [
        'active' => 'boolean',
        'images' => 'array',
    ];

    // Add appends to automatically include currency info
    protected $appends = ['currency', 'currency_symbol'];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function serviceSlots(): HasMany
    {
        return $this->hasMany(ServiceSlot::class);
    }

    public function isProduct(): bool
    {
        return $this->type === 'product';
    }

    public function isService(): bool
    {
        return $this->type === 'service';
    }

    // Currency accessor - inherits from vendor
    public function getCurrencyAttribute(): string
    {
        return $this->vendor->currency ?? 'USD';
    }

    // Currency symbol accessor
    public function getCurrencySymbolAttribute(): string
    {
        return $this->vendor->getCurrencySymbol() ?? '$';
    }

    // Helper method to format price with vendor's currency
    public function formatPrice(float $price): string
    {
        return $this->vendor->formatPrice($price);
    }
}
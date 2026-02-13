<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'brief',
        'category',
        'website',
        'street_address',
        'city',
        'state_province',
        'postal_code',
        'currency', // Add this
        'verified_at',
    ];

    protected $casts = [
        'category' => 'array',
        'verified_at' => 'datetime',
    ];

    // Add currency constants
    public const CURRENCY_USD = 'USD';
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_GBP = 'GBP';

    public const CURRENCIES = [
        self::CURRENCY_USD => ['symbol' => '$', 'name' => 'US Dollar'],
        self::CURRENCY_EUR => ['symbol' => '€', 'name' => 'Euro'],
        self::CURRENCY_GBP => ['symbol' => '£', 'name' => 'British Pound'],
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(VendorReview::class);
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function getReviewCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }

    // Add currency helper methods
    public function getCurrencySymbol(): string
    {
        return self::CURRENCIES[$this->currency]['symbol'] ?? '$';
    }

    public function getCurrencyName(): string
    {
        return self::CURRENCIES[$this->currency]['name'] ?? 'US Dollar';
    }

    public function formatPrice(float $price): string
    {
        return $this->getCurrencySymbol() . number_format($price, 2);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PractitionerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'application_id',
        'phone_number',
        'professional_title',
        'years_experience',
        'bio',
        'license_number',
        'issuing_organization',
        'primary_category_id',
        'service_description',
        'availability_schedule',
        'timezone',
        'is_active',
        'is_accepting_clients',
        'profile_image_path',
        'total_bookings',
        'average_rating',
        'total_reviews',
        'approved_at',
    ];

    protected $casts = [
        'availability_schedule' => 'array',
        'is_active' => 'boolean',
        'is_accepting_clients' => 'boolean',
        'total_bookings' => 'integer',
        'average_rating' => 'decimal:2',
        'total_reviews' => 'integer',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the original application.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(PractitionerApplication::class, 'application_id');
    }

    /**
     * Get the primary service category.
     */
    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'primary_category_id');
    }

    /**
     * Get the specific services offered.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceSubcategory::class,
            'practitioner_services',
            'practitioner_profile_id',
            'subcategory_id'
        )->withTimestamps();
    }

    /**
     * Scope for active profiles.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for profiles accepting clients.
     */
    public function scopeAcceptingClients($query)
    {
        return $query->where('is_accepting_clients', true);
    }

    /**
     * Scope for profiles by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('primary_category_id', $categoryId);
    }

    /**
     * Scope to order by rating.
     */
    public function scopeTopRated($query)
    {
        return $query->whereNotNull('average_rating')->orderByDesc('average_rating');
    }

    /**
     * Update the rating statistics.
     */
    public function updateRatingStats(float $averageRating, int $totalReviews): void
    {
        $this->update([
            'average_rating' => $averageRating,
            'total_reviews' => $totalReviews,
        ]);
    }

    /**
     * Increment booking count.
     */
    public function incrementBookings(): void
    {
        $this->increment('total_bookings');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(PractitionerApplication::class, 'application_id');
    }

    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'primary_category_id');
    }

    /**
     * The subcategories this practitioner offers — via the existing practitioner_services pivot table.
     */
    public function serviceSubcategories(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceSubcategory::class,
            'practitioner_services',
            'practitioner_profile_id',
            'subcategory_id'
        )->withTimestamps();
    }

    /**
     * Alias for serviceSubcategories() — used by application service.
     */
    public function services(): BelongsToMany
    {
        return $this->serviceSubcategories();
    }

    /**
     * The bookable offerings this practitioner has created.
     */
    public function offerings(): HasMany
    {
        return $this->hasMany(PractitionerOffering::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAcceptingClients($query)
    {
        return $query->where('is_accepting_clients', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('primary_category_id', $categoryId);
    }

    public function scopeTopRated($query)
    {
        return $query->whereNotNull('average_rating')->orderByDesc('average_rating');
    }

    public function updateRatingStats(float $averageRating, int $totalReviews): void
    {
        $this->update([
            'average_rating' => $averageRating,
            'total_reviews' => $totalReviews,
        ]);
    }

    public function incrementBookings(): void
    {
        $this->increment('total_bookings');
    }
}

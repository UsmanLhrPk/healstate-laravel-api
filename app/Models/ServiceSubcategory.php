<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceSubcategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * Get the category that owns the subcategory.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    /**
     * Get the practitioner applications that offer this service.
     */
    public function practitionerApplications(): BelongsToMany
    {
        return $this->belongsToMany(
            PractitionerApplication::class,
            'application_services',
            'subcategory_id',
            'application_id'
        )->withTimestamps();
    }

    /**
     * Get the practitioner profiles that offer this service.
     */
    public function practitionerProfiles(): BelongsToMany
    {
        return $this->belongsToMany(
            PractitionerProfile::class,
            'practitioner_services',
            'subcategory_id',
            'practitioner_profile_id'
        )->withTimestamps();
    }

    /**
     * Scope to get only active subcategories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by display order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    /**
     * Scope to filter by category.
     */
    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
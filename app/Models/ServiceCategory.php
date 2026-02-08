<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Get the subcategories for the category.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(ServiceSubcategory::class, 'category_id');
    }

    /**
     * Get active subcategories.
     */
    public function activeSubcategories(): HasMany
    {
        return $this->subcategories()->where('is_active', true)->orderBy('display_order');
    }

    /**
     * Get practitioner applications for this category.
     */
    public function practitionerApplications(): HasMany
    {
        return $this->hasMany(PractitionerApplication::class, 'primary_category_id');
    }

    /**
     * Get practitioner profiles for this category.
     */
    public function practitionerProfiles(): HasMany
    {
        return $this->hasMany(PractitionerProfile::class, 'primary_category_id');
    }

    /**
     * Scope to get only active categories.
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
}
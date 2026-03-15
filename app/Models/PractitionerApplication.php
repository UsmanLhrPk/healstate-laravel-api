<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PractitionerApplication extends Model
{
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'submitted_at';

    protected $fillable = [
        'user_id',
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
        'status',
        'reviewed_by',
        'reviewed_at',
        'rejection_reason',
        'admin_notes',
        'terms_agreed',
        'terms_agreed_at',
    ];

    protected $casts = [
        'availability_schedule' => 'array',
        'terms_agreed' => 'boolean',
        'terms_agreed_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'submitted_at' => 'datetime',
        'updated_at' => 'datetime',
    ]; 

    /**
     * Get the user that owns the application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the primary service category.
     */
    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'primary_category_id');
    }

    /**
     * Get the admin who reviewed the application.
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the specific services offered.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceSubcategory::class,
            'application_services',
            'application_id',
            'subcategory_id'
        ) ->withPivot('created_at');
    }

    /**
     * Get the uploaded documents.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class, 'application_id');
    }

    /**
     * Get the practitioner profile (if approved).
     */
    public function practitionerProfile(): HasOne
    {
        return $this->hasOne(PractitionerProfile::class, 'application_id');
    }

    /**
     * Scope for pending applications.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved applications.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected applications.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if application is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if application is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if application is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
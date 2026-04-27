<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, \Illuminate\Auth\MustVerifyEmail, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_practitioner',
        'practitioner_profile_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Appended computed attributes included in every JSON/array response.
     *
     * @var list<string>
     */
    protected $appends = [
        'has_pending_practitioner_application',
        'is_vendor',
        'has_pending_vendor_application',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_practitioner' => 'boolean',
        ];
    }

    public function vendor()
    {
        return $this->hasOne(\App\Models\Vendor::class);
    }

    /**
     * Get the user's practitioner applications.
     */
    public function practitionerApplications()
    {
        return $this->hasMany(\App\Models\PractitionerApplication::class);
    }

    /**
     * Get the user's practitioner profile.
     */
    public function practitionerProfile()
    {
        return $this->hasOne(\App\Models\PractitionerProfile::class);
    }

    public function courses()
    {
        return $this->hasMany(\App\Models\Course::class);
    }

    public function courseEnrollments()
    {
        return $this->hasMany(\App\Models\CourseEnrollment::class);
    }

    /**
     * Check if user has a pending practitioner application.
     */
    public function hasPendingPractitionerApplication(): bool
    {
        return $this->practitionerApplications()
            ->where('status', 'pending')
            ->exists();
    }

    /**
     * Check if user has an approved practitioner application.
     */
    public function hasApprovedPractitionerApplication(): bool
    {
        return $this->practitionerApplications()
            ->where('status', 'approved')
            ->exists();
    }

    /**
     * Check if user is a practitioner.
     */
    public function isPractitioner(): bool
    {
        return $this->is_practitioner === true;
    }

    /**
     * Get user's latest practitioner application.
     */
    public function getLatestPractitionerApplication()
    {
        return $this->practitionerApplications()
            ->latest('submitted_at')
            ->first();
    }

    // -------------------------------------------------------------------------
    // Appended attributes — automatically included in toArray() / toJson()
    // -------------------------------------------------------------------------

    /**
     * Whether the user has a pending practitioner application.
     * Replaces the manual serialization that was previously done in controllers.
     */
    public function getHasPendingPractitionerApplicationAttribute(): bool
    {
        return $this->hasPendingPractitionerApplication();
    }

    /**
     * Whether the user's vendor profile has been verified by an admin.
     * Requires the vendor relationship to be loaded or will lazy-load it.
     */
    public function getIsVendorAttribute(): bool
    {
        return $this->vendor?->status === \App\Models\Vendor::STATUS_APPROVED;
    }

    /**
     * Whether the user has submitted a vendor application that is not yet approved.
     */
    public function getHasPendingVendorApplicationAttribute(): bool
    {
        if (!$this->vendor_id) {
            return false;
        }

        return $this->vendor?->status === \App\Models\Vendor::STATUS_PENDING;
    }
}

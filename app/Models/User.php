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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
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
}

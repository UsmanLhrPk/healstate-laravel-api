<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PractitionerOffering extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_profile_id',
        'subcategory_id',
        'title',
        'brief',
        'description',
        'duration',
        'price',
        'active',
        'images',
    ];

    protected $casts = [
        'active'   => 'boolean',
        'images'   => 'array',
        'duration' => 'integer',
        'price'    => 'decimal:2',
    ];

    public function practitionerProfile(): BelongsTo
    {
        return $this->belongsTo(PractitionerProfile::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(ServiceSubcategory::class);
    }

    public function slots(): HasMany
    {
        return $this->hasMany(PractitionerOfferingSlot::class);
    }
}
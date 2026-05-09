<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PENDING = 'pending';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_REJECTED = 'rejected';

    public const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'subtitle',
        'category_id',
        'description',
        'thumbnail_path',
        'promo_video_path',
        'promo_video_url',
        'difficulty_level',
        'language',
        'pricing_type',
        'price',
        'discount_price',
        'is_featured',
        'total_enrollments',
        'average_rating',
        'total_reviews',
        'total_duration_minutes',
        'reviewed_by',
        'reviewed_at',
        'rejection_reason',
        'admin_notes',
        'status',
        'published_at',
        'submitted_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'total_enrollments' => 'integer',
        'average_rating' => 'decimal:2',
        'total_reviews' => 'integer',
        'total_duration_minutes' => 'integer',
        'reviewed_at' => 'datetime',
        'published_at' => 'datetime',
        'submitted_at' => 'datetime',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(CourseModule::class)->orderBy('display_order');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->belongsToMany(
            ServiceSubcategory::class,
            'course_subcategories',
            'course_id',
            'subcategory_id'
        );
    }

    public function outcomes(): HasMany
    {
        return $this->hasMany(CourseOutcome::class)->orderBy('display_order');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(CourseRequirement::class)->orderBy('display_order');
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if (! $this->thumbnail_path) {
            return null;
        }

        return Storage::url($this->thumbnail_path);
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(CourseReview::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function media(): HasMany
    {
        return $this->hasMany(CourseMedia::class);
    }
}

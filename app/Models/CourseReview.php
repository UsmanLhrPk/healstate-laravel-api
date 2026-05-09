<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseReview extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'enrollment_id',
        'rating',
        'review_text',
        'is_visible',
        'deletion_count',
    ];

    protected $casts = [
        'rating'         => 'integer',
        'is_visible'     => 'boolean',
        'deletion_count' => 'integer',
    ];

    // ── Relationships ────────────────────────────────────────

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(CourseEnrollment::class);
    }
}
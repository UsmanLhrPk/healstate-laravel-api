<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseEnrollment extends Model
{
    use HasFactory;

    public const TYPE_FREE = 'free';
    public const TYPE_PAID = 'paid';

    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'user_id',
        'enrollment_type',
        'amount_paid',
        'payment_reference',
        'progress_percent',
        'is_completed',
        'enrolled_at',
        'last_accessed_at',
        'completed_at',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'progress_percent' => 'decimal:2',
        'is_completed' => 'boolean',
        'enrolled_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(CourseLessonProgress::class, 'enrollment_id');
    }
}

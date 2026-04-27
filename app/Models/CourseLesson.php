<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseLesson extends Model
{
    use HasFactory;

    protected $table = 'course_lessons';

    protected $fillable = [
        'section_id',
        'course_id',
        'title',
        'lesson_type',
        'video_path',
        'video_url',
        'text_content',
        'pdf_path',
        'duration_minutes',
        'is_preview',
        'display_order',
    ];

    protected $casts = [
        'duration_minutes' => 'integer',
        'is_preview' => 'boolean',
        'display_order' => 'integer',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(CourseModule::class, 'section_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function progressRecords(): HasMany
    {
        return $this->hasMany(CourseLessonProgress::class, 'lesson_id');
    }
}

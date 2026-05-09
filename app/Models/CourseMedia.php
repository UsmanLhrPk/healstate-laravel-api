<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CourseMedia extends Model
{
    public $timestamps = false; // table uses uploaded_at, not created_at/updated_at

    protected $fillable = [
        'course_id',
        'lesson_id',
        'uploader_id',
        'media_type',
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'duration_seconds',
        'uploaded_at',
    ];

    protected $casts = [
        'file_size'        => 'integer',
        'duration_seconds' => 'integer',
        'uploaded_at'      => 'datetime',
    ];

    // ── Media type constants ────────────────────────────────

    const TYPE_THUMBNAIL   = 'thumbnail';
    const TYPE_PROMO_VIDEO = 'promo_video';
    const TYPE_LESSON_VIDEO= 'lesson_video';
    const TYPE_LESSON_PDF  = 'lesson_pdf';
    const TYPE_ATTACHMENT  = 'attachment';

    // ── Relationships ────────────────────────────────────────

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(CourseLesson::class, 'lesson_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    // ── Accessors ────────────────────────────────────────────

    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;

        if ($bytes >= 1_048_576) {
            return round($bytes / 1_048_576, 2) . ' MB';
        }

        if ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }
}
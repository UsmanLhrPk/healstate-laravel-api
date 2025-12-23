<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'category',
        'sub_category',
        'author_id',
        'status',
        'views',
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically set status to 'flagged' when flags reach 10
        static::updated(function ($forum) {
            if ($forum->flags_count >= 10 && $forum->status === 'approved') {
                $forum->status = 'flagged';
                $forum->saveQuietly(); // Save without triggering events again
            }
        });
    }

    // Relationships
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function flags(): MorphMany
    {
        return $this->morphMany(Flag::class, 'flaggable');
    }

    // NEW: Add this relationship
    public function views(): MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }

    // Helper methods
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    // NEW: Add this method
    public function hasBeenViewedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->views()->where('user_id', $userId)->exists();
    }

    // NEW: Add this method
    public function recordView(int $userId): bool
    {
        $cacheKey = "forum_{$this->id}_user_{$userId}_last_view";
        $lastView = cache()->get($cacheKey);

        \Log::info('🔍 Checking view cooldown', [
            'forum_id' => $this->id,
            'user_id' => $userId,
            'cache_key' => $cacheKey,
            'last_view' => $lastView,
            'has_cached_view' => ! is_null($lastView),
        ]);

        // Only record if no view in the last 2 hours
        if ($lastView) {
            \Log::info('❌ View blocked - still in cooldown', [
                'last_view_time' => $lastView,
                'minutes_since_last_view' => now()->diffInMinutes($lastView),
            ]);

            return false; // Return false to indicate view was not recorded
        }

        // Increment views
        $this->increment('views');

        // Cache for 2 hours (120 minutes)
        cache()->put($cacheKey, now(), now()->addHours(2));

        \Log::info('✅ View recorded successfully', [
            'forum_id' => $this->id,
            'new_view_count' => $this->views + 1,
            'cooldown_until' => now()->addHours(2),
        ]);

        return true; // Return true to indicate view was recorded
    }

    public function isLikedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function isFlaggedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->flags()->where('user_id', $userId)->exists();
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeBySubCategory($query, string $subCategory)
    {
        return $query->where('sub_category', $subCategory);
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('views');
    }

    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at');
    }
}

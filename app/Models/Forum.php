<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    // Append dynamic attributes to JSON
    protected $appends = [
        'comments_count',
        'likes_count',
        'flags_count',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically set status to 'flagged' when flags reach 10
        static::updated(function ($forum) {
            $flagsCount = $forum->flags()->count();
            if ($flagsCount >= 10 && $forum->status === 'approved') {
                $forum->status = 'flagged';
                $forum->saveQuietly();
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

    public function views(): MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }

    // Dynamic Count Accessors - Always return real counts from database
    
    /**
     * Get comments count (handles both single and double backslashes)
     */
    public function getCommentsCountAttribute(): int
    {
        return DB::table('comments')
            ->where('commentable_id', $this->id)
            ->where(function($query) {
                $query->where('commentable_type', 'App\Models\Forum')
                      ->orWhere('commentable_type', 'App\\Models\\Forum');
            })
            ->whereNull('parent_id')  // Only count top-level comments
            ->whereNull('deleted_at')
            ->count();
    }

    /**
     * Get likes count
     */
    public function getLikesCountAttribute(): int
    {
        return DB::table('likes')
            ->where('likeable_id', $this->id)
            ->where('likeable_type', 'App\Models\Forum')
            ->count();
    }

    /**
     * Get flags count
     */
    public function getFlagsCountAttribute(): int
    {
        return DB::table('flags')
            ->where('flaggable_id', $this->id)
            ->where('flaggable_type', 'App\Models\Forum')
            ->count();
    }

    // Helper methods
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function hasBeenViewedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->views()->where('user_id', $userId)->exists();
    }

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

            return false;
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

        return true;
    }

    public function isLikedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Toggle like for a user
     * Creates a like record if not exists, deletes if exists
     * 
     * @param int $userId
     * @return array ['liked' => bool, 'like_count' => int]
     */
    public function toggleLike(int $userId): array
    {
        $like = $this->likes()
            ->where('user_id', $userId)
            ->first();
        
        if ($like) {
            // Unlike - delete the record
            $like->delete();
            return [
                'liked' => false,
                'like_count' => $this->likes_count, // Uses accessor
            ];
        } else {
            // Like - create a record
            $this->likes()->create([
                'user_id' => $userId,
            ]);
            return [
                'liked' => true,
                'like_count' => $this->likes_count, // Uses accessor
            ];
        }
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
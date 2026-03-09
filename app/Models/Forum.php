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

    // Forum type constants — single source of truth used by model, service, and request
    const TYPE_GENERAL = 'general';
    const TYPE_HEALER  = 'healer';
    const TYPE_VENDOR  = 'vendor';

    const TYPES = [self::TYPE_GENERAL, self::TYPE_HEALER, self::TYPE_VENDOR];

    protected $fillable = [
        'title',
        'content',
        'category',
        'sub_category',
        'forum_type',
        'author_id',
        'status',
        'views',
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    protected $appends = [
        'comments_count',
        'likes_count',
        'flags_count',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($forum) {
            $flagsCount = $forum->flags()->count();
            if ($flagsCount >= 10 && $forum->status === 'approved') {
                $forum->status = 'flagged';
                $forum->saveQuietly();
            }
        });
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

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

    // -------------------------------------------------------------------------
    // Dynamic count accessors
    // -------------------------------------------------------------------------

    public function getCommentsCountAttribute(): int
    {
        return DB::table('comments')
            ->where('commentable_id', $this->id)
            ->where(function ($query) {
                $query->where('commentable_type', 'App\Models\Forum')
                      ->orWhere('commentable_type', 'App\\Models\\Forum');
            })
            ->whereNull('parent_id')
            ->whereNull('deleted_at')
            ->count();
    }

    public function getLikesCountAttribute(): int
    {
        return DB::table('likes')
            ->where('likeable_id', $this->id)
            ->where('likeable_type', 'App\Models\Forum')
            ->count();
    }

    public function getFlagsCountAttribute(): int
    {
        return DB::table('flags')
            ->where('flaggable_id', $this->id)
            ->where('flaggable_type', 'App\Models\Forum')
            ->count();
    }

    // -------------------------------------------------------------------------
    // Helper methods
    // -------------------------------------------------------------------------

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

        if ($lastView) {
            return false;
        }

        $this->increment('views');
        cache()->put($cacheKey, now(), now()->addHours(2));

        return true;
    }

    public function isLikedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function toggleLike(int $userId): array
    {
        $like = $this->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return ['liked' => false, 'like_count' => $this->likes_count];
        }

        $this->likes()->create(['user_id' => $userId]);
        return ['liked' => true, 'like_count' => $this->likes_count];
    }

    public function isFlaggedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->flags()->where('user_id', $userId)->exists();
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

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

    public function scopeByForumType($query, string $forumType)
    {
        return $query->where('forum_type', $forumType);
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
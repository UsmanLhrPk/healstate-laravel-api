<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'comment',
        'author_id',
        'commentable_type',
        'commentable_id',
        'parent_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Append dynamic attributes to JSON
    protected $appends = [
        'likes_count',
        'flags_count',
        'replies_count',
    ];

    /**
     * Scope to query by commentable, handling both slash formats
     */
    public function scopeForCommentable($query, string $commentableType, int $commentableId)
    {
        \Log::info('scopeForCommentable called', [
            'type' => $commentableType,
            'id' => $commentableId,
        ]);

        // Match by ID and handle both single and double backslashes for Forum
        return $query->where('commentable_id', $commentableId)
            ->where(function ($q) {
                $q->where('commentable_type', 'App\Models\Forum')
                  ->orWhere('commentable_type', 'App\\Models\\Forum')
                  ->orWhere('commentable_type', 'LIKE', '%Forum%')
                  ->orWhere('commentable_type', 'LIKE', '%forum%');
            });
    }

    // Relationships
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function flags(): MorphMany
    {
        return $this->morphMany(Flag::class, 'flaggable');
    }

    // Dynamic Count Accessors - Always return real counts from database

    /**
     * Get likes count (real-time from database)
     */
    public function getLikesCountAttribute(): int
    {
        return DB::table('likes')
            ->where('likeable_id', $this->id)
            ->where(function($query) {
                $query->where('likeable_type', 'App\Models\Comment')
                      ->orWhere('likeable_type', 'App\\Models\\Comment');
            })
            ->count();
    }

    /**
     * Get flags count (real-time from database)
     */
    public function getFlagsCountAttribute(): int
    {
        return DB::table('flags')
            ->where('flaggable_id', $this->id)
            ->where(function($query) {
                $query->where('flaggable_type', 'App\Models\Comment')
                      ->orWhere('flaggable_type', 'App\\Models\\Comment');
            })
            ->count();
    }

    /**
     * Get replies count (real-time from database)
     */
    public function getRepliesCountAttribute(): int
    {
        return DB::table('comments')
            ->where('parent_id', $this->id)
            ->whereNull('deleted_at')
            ->count();
    }

    /**
     * Legacy support - alias for likes_count
     * @deprecated Use likes_count instead
     */
    public function getLikeCountAttribute(): int
    {
        return $this->likes_count;
    }

    // Helper Methods
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
                'like_count' => $this->likes_count, // Uses dynamic accessor
            ];
        } else {
            // Like - create a record
            $this->likes()->create([
                'user_id' => $userId,
            ]);

            return [
                'liked' => true,
                'like_count' => $this->likes_count, // Uses dynamic accessor
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
}
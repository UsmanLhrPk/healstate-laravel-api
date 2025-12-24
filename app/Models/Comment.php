<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function getLikeCountAttribute(): int
    {
        return $this->likes()->count();
    }

    public function isLikedBy(?int $userId): bool
    {
        if (!$userId) {
            return false;
        }
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Toggle like for a user
     * Creates a like record if not exists, deletes if exists
     * 
     * @param int $userId
     * @return array ['liked' => bool, 'likes_count' => int]
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
                'likes_count' => $this->likes()->count(),
            ];
        } else {
            // Like - create a record
            $this->likes()->create([
                'user_id' => $userId,
            ]);
            return [
                'liked' => true,
                'likes_count' => $this->likes()->count(),
            ];
        }
    }

    public function isFlaggedBy(?int $userId): bool
    {
        if (!$userId) {
            return false;
        }
        return $this->flags()->where('user_id', $userId)->exists();
    }
}
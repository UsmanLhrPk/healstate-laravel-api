<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    // Helper methods
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function isLikedBy(?int $userId): bool
    {
        if (!$userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function isFlaggedBy(?int $userId): bool
    {
        if (!$userId) {
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
<?php

namespace App\Services;

use App\Models\Like;

class LikeService
{
    /**
     * Toggle like on a likeable entity
     * 
     * If like exists: delete it (unlike)
     * If like doesn't exist: create it
     * 
     * Returns: ['liked' => bool, 'like_count' => int]
     */
    public function toggleLike(string $likeableType, int $likeableId, int $userId): array
    {
        $like = Like::where('user_id', $userId)
            ->where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->first();

        if ($like) {
            // Unlike - delete the like
            $like->delete();
            $liked = false;
        } else {
            // Like - create new like
            Like::create([
                'user_id' => $userId,
                'likeable_type' => $likeableType,
                'likeable_id' => $likeableId,
            ]);
            $liked = true;
        }

        // Get updated like count
        $likeCount = Like::where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->count();

        return [
            'liked' => $liked,
            'like_count' => $likeCount,
        ];
    }

    /**
     * Check if a user has liked a specific entity
     */
    public function hasUserLiked(string $likeableType, int $likeableId, int $userId): bool
    {
        return Like::where('user_id', $userId)
            ->where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->exists();
    }

    /**
     * Get like count for a specific entity
     */
    public function getLikeCount(string $likeableType, int $likeableId): int
    {
        return Like::where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->count();
    }
}
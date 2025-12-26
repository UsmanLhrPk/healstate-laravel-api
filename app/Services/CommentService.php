<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentService
{
    /**
     * Get top-level comments with 3 most recent replies each
     * Paginated 10 per page
     */
    public function getTopLevelComments(string $commentableType, int $commentableId): LengthAwarePaginator
    {
        $userId = optional(auth('sanctum')->user())->id;

        \Log::info('Loading comments', ['user_id' => $userId, 'auth_check' => auth('sanctum')->check()]);

        $comments = Comment::forCommentable($commentableType, $commentableId)
            ->whereNull('parent_id')
            ->with([
                'author:id,name,email',
                'replies' => function ($query) {
                    $query->latest()
                        ->limit(3)
                        ->with('author:id,name,email')
                        ->withCount(['likes', 'flags', 'replies']);
                }
            ])
            ->withCount(['likes', 'flags', 'replies'])
            ->latest()
            ->paginate(10);

        // Transform the collection to add is_liked and is_flagged
        $comments->getCollection()->transform(function ($comment) use ($userId) {
            $comment->is_liked = $comment->isLikedBy($userId);
            $comment->is_flagged = $comment->isFlaggedBy($userId);
            
            if ($comment->replies) {
                $comment->replies->transform(function ($reply) use ($userId) {
                    $reply->is_liked = $reply->isLikedBy($userId);
                    $reply->is_flagged = $reply->isFlaggedBy($userId);
                    return $reply;
                });
            }
            
            return $comment;
        });

        return $comments;
    }

    /**
     * Get paginated replies for a specific comment
     * 10 per page
     */
    public function getReplies(int $parentId): LengthAwarePaginator
    {
        // Use optional() to get user ID even if not authenticated
        $userId = optional(auth('sanctum')->user())->id;

        $replies = Comment::where('parent_id', $parentId)
            ->with('author:id,name,email')
            ->withCount(['likes', 'flags', 'replies'])
            ->latest()
            ->paginate(10);

        // Transform the collection to add is_liked and is_flagged
        $replies->getCollection()->transform(function ($reply) use ($userId) {
            $reply->is_liked = $reply->isLikedBy($userId);
            $reply->is_flagged = $reply->isFlaggedBy($userId);
            return $reply;
        });

        return $replies;
    }

    /**
     * Create a new comment
     * Normalizes commentable_type to ensure consistency
     */
    public function createComment(array $data, int $authorId): Comment
    {
        // CRITICAL: Normalize commentable_type to single backslash format
        $commentableType = $this->normalizeCommentableType($data['commentable_type']);

        $comment = Comment::create([
            'comment' => $data['comment'],
            'commentable_type' => $commentableType,
            'commentable_id' => $data['commentable_id'],
            'parent_id' => $data['parent_id'] ?? null,
            'author_id' => $authorId,
        ]);

        \Log::info('Comment created', [
            'comment_id' => $comment->id,
            'normalized_type' => $commentableType,
            'original_type' => $data['commentable_type'],
        ]);

        return $comment;
    }

    /**
     * Normalize commentable_type to standard format (single backslash)
     */
    private function normalizeCommentableType(string $type): string
    {
        // Remove extra backslashes and normalize
        $type = str_replace('\\\\', '\\', $type);
        
        // Map known types to their standard format
        if (stripos($type, 'Forum') !== false) {    
            return 'App\Models\Forum';
        }
        
        if (stripos($type, 'Comment') !== false) {
            return 'App\Models\Comment';
        }

        // Return as-is if not recognized (shouldn't happen)
        \Log::warning('Unknown commentable_type', ['type' => $type]);
        return $type;
    }

    /**
     * Soft delete a comment
     */
    public function deleteComment(Comment $comment): bool
    {
        return $comment->delete();
    }
}
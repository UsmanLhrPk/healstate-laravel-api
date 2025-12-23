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
        $userId = auth()->id();

        return Comment::where('commentable_type', $commentableType)
            ->where('commentable_id', $commentableId)
            ->whereNull('parent_id')
            ->with([
                'author:id,name,email',
                'replies' => function ($query) use ($userId) {
                    $query->latest()
                        ->limit(3)
                        ->with([
                            'author:id,name,email',
                            'likes',
                            'flags'
                        ])
                        ->withCount(['likes','replies'])
                        ->when($userId, function ($q) use ($userId) {
                            $q->addSelect([
                                'is_liked' => function ($subQuery) use ($userId) {
                                    $subQuery->selectRaw('EXISTS(SELECT 1 FROM likes WHERE likeable_type = ? AND likeable_id = comments.id AND user_id = ?)', ['App\Models\Comment', $userId]);
                                },
                                'is_flagged' => function ($subQuery) use ($userId) {
                                    $subQuery->selectRaw('EXISTS(SELECT 1 FROM flags WHERE flaggable_type = ? AND flaggable_id = comments.id AND user_id = ?)', ['App\Models\Comment', $userId]);
                                }
                            ]);
                        });
                },
                'likes',
                'flags'
            ])
            ->withCount(['likes', 'replies'])
            ->when($userId, function ($query) use ($userId) {
                $query->addSelect([
                    'is_liked' => function ($subQuery) use ($userId) {
                        $subQuery->selectRaw('EXISTS(SELECT 1 FROM likes WHERE likeable_type = ? AND likeable_id = comments.id AND user_id = ?)', ['App\Models\Comment', $userId]);
                    },
                    'is_flagged' => function ($subQuery) use ($userId) {
                        $subQuery->selectRaw('EXISTS(SELECT 1 FROM flags WHERE flaggable_type = ? AND flaggable_id = comments.id AND user_id = ?)', ['App\Models\Comment', $userId]);
                    }
                ]);
            })
            ->latest()
            ->paginate(10);
    }

    /**
     * Get paginated replies for a specific comment
     * 10 per page
     */
    public function getReplies(int $parentId): LengthAwarePaginator
    {
        $userId = auth()->id();

        return Comment::where('parent_id', $parentId)
            ->with([
                'author:id,name,email',
                'likes',
                'flags'
            ])
            ->withCount('likes')
            ->when($userId, function ($query) use ($userId) {
                $query->addSelect([
                    'is_liked' => function ($subQuery) use ($userId) {
                        $subQuery->selectRaw('EXISTS(SELECT 1 FROM likes WHERE likeable_type = ? AND likeable_id = comments.id AND user_id = ?)', ['App\Models\Comment', $userId]);
                    },
                    'is_flagged' => function ($subQuery) use ($userId) {
                        $subQuery->selectRaw('EXISTS(SELECT 1 FROM flags WHERE flaggable_type = ? AND flaggable_id = comments.id AND user_id = ?)', ['App\Models\Comment', $userId]);
                    }
                ]);
            })
            ->latest()
            ->paginate(10);
    }

    /**
     * Create a new comment
     */
    public function createComment(array $data, int $authorId): Comment
    {
        $comment = Comment::create([
            'comment' => $data['comment'],
            'commentable_type' => $data['commentable_type'],
            'commentable_id' => $data['commentable_id'],
            'parent_id' => $data['parent_id'] ?? null,
            'author_id' => $authorId,
        ]);

        return $comment;
    }

    /**
     * Soft delete a comment
     */
    public function deleteComment(Comment $comment): bool
    {
        return $comment->delete();
    }
}
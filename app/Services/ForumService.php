<?php

namespace App\Services;

use App\Models\Forum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ForumService
{
    /**
     * Get paginated list of forums with filters
     */
    public function getForums(
        ?string $category = null,
        ?string $subCategory = null,
        string $sort = 'latest',
        int $perPage = 20
    ): LengthAwarePaginator {
        $query = Forum::with(['author:id,name,email'])
            ->withCount(['comments', 'likes', 'flags'])
            ->approved();

        if ($category) {
            $query->byCategory($category);
        }

        if ($subCategory) {
            $query->bySubCategory($subCategory);
        }

        if ($sort === 'popular') {
            $query->popular();
        } else {
            $query->latest();
        }

        return $query->paginate($perPage);
    }

    /**
     * Get single forum with comments
     * UPDATED: Now uses proper view tracking
     */
    public function getForumWithComments(int $forumId, ?int $userId = null): array
    {
        \Log::info('=== getForumWithComments ===', [
        'forum_id' => $forumId,
        'user_id' => $userId,
        'auth_check' => auth()->check(),
        'auth_id' => auth()->id(),
    ]);
        $forum = Forum::with(['author:id,name,email'])
            ->withCount(['comments', 'likes', 'flags'])
            ->findOrFail($forumId);

        // UPDATED: Record view only once per user (permanent)
        if ($userId) {
            $forum->recordView($userId);
        }

        $comments = $forum->comments()
            ->with(['author:id,name,email'])
            ->withCount(['likes', 'flags', 'replies'])
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $comments->getCollection()->transform(function ($comment) use ($userId) {
            $comment->recent_replies = $comment->replies()
                ->with(['author:id,name,email'])
                ->withCount(['likes', 'flags'])
                ->limit(3)
                ->get()
                ->map(function ($reply) use ($userId) {
                    $reply->is_liked = $reply->isLikedBy($userId);
                    $reply->is_flagged = $reply->isFlaggedBy($userId);
                    return $reply;
                });

            $comment->is_liked = $comment->isLikedBy($userId);
            $comment->is_flagged = $comment->isFlaggedBy($userId);

            return $comment;
        });

        $forum->is_liked = $forum->isLikedBy($userId);
        $forum->is_flagged = $forum->isFlaggedBy($userId);

        return [
            'forum' => $forum,
            'comments' => $comments,
        ];
    }

    /**
     * Create a new forum
     */
    public function createForum(array $data, int $authorId): Forum
    {
        $forum = Forum::create([
            ...$data,
            'author_id' => $authorId,
            'status' => 'approved',
        ]);

        $forum->load(['author:id,name,email']);

        return $forum;
    }

    /**
     * Delete a forum
     */
    public function deleteForum(int $forumId, int $userId): void
    {
        $forum = Forum::findOrFail($forumId);

        if ($forum->author_id !== $userId) {
            throw new \Exception('Unauthorized to delete this forum');
        }

        $forum->delete();
    }

    /**
     * Check if forum exists
     */
    public function forumExists(int $forumId): bool
    {
        return Forum::where('id', $forumId)->exists();
    }

    /**
     * Get forum by ID
     */
    public function getForumById(int $forumId): Forum
    {
        return Forum::findOrFail($forumId);
    }
}
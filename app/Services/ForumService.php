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

        // Apply filters
        if ($category) {
            $query->byCategory($category);
        }

        if ($subCategory) {
            $query->bySubCategory($subCategory);
        }

        // Apply sorting
        if ($sort === 'popular') {
            $query->popular();
        } else {
            $query->latest();
        }

        return $query->paginate($perPage);
    }

    /**
     * Get single forum with comments
     */
    public function getForumWithComments(int $forumId, ?int $userId = null): array
    {
        $forum = Forum::with(['author:id,name,email'])
            ->withCount(['comments', 'likes', 'flags'])
            ->findOrFail($forumId);

        // Increment views if user is not the author
        if (!$userId || $forum->author_id !== $userId) {
            $forum->incrementViews();
        }

        // Get top-level comments with their 3 most recent replies
        $comments = $forum->comments()
            ->with(['author:id,name,email'])
            ->withCount(['likes', 'flags', 'replies'])
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Load 3 most recent replies for each top-level comment
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

        // Add like/flag status for the forum
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

        // Check if user is the author
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
<?php

namespace App\Services;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ForumService
{
    /**
     * Get paginated list of forums, optionally filtered by type.
     */
    public function getForums(
        ?string $category    = null,
        ?string $subCategory = null,
        ?string $forumType   = null,
        string  $sort        = 'latest',
        int     $perPage     = 10
    ): LengthAwarePaginator {
        $query = Forum::with(['author:id,name,email'])
            ->where('status', 'approved');

        if ($category) {
            $query->byCategory($category);
        }

        if ($subCategory) {
            $query->bySubCategory($subCategory);
        }

        // Filter by forum_type when explicitly requested.
        // When null, all types are returned (e.g. landing page / search).
        if ($forumType && in_array($forumType, Forum::TYPES)) {
            $query->byForumType($forumType);
        }

        if ($sort === 'popular') {
            $query->popular();
        } else {
            $query->latest();
        }

        return $query->paginate($perPage);
    }

    /**
     * Get single forum with paginated comments.
     */
    public function getForumWithComments(int $forumId, ?int $userId = null): array
    {
        $forum = Forum::with(['author:id,name,email'])
            ->findOrFail($forumId);

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
                    $reply->is_liked   = $reply->isLikedBy($userId);
                    $reply->is_flagged = $reply->isFlaggedBy($userId);
                    return $reply;
                });

            $comment->is_liked   = $comment->isLikedBy($userId);
            $comment->is_flagged = $comment->isFlaggedBy($userId);

            return $comment;
        });

        $forum->is_liked   = $forum->isLikedBy($userId);
        $forum->is_flagged = $forum->isFlaggedBy($userId);

        return [
            'forum'    => $forum,
            'comments' => $comments,
        ];
    }

    /**
     * Create a new forum.
     *
     * Business rules:
     *   - forum_type 'healer' → author must be a practitioner (is_practitioner === true)
     *   - forum_type 'vendor' → author must be an approved vendor
     *   - forum_type 'general' → any authenticated user
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createForum(array $data, int $authorId): Forum
    {
        $user      = User::findOrFail($authorId);
        $forumType = $data['forum_type'] ?? Forum::TYPE_GENERAL;

        $this->authorizeForumType($user, $forumType);

        $forum = Forum::create([
            ...$data,
            'author_id'  => $authorId,
            'forum_type' => $forumType,
            'status'     => 'approved',
        ]);

        $forum->load(['author:id,name,email']);

        return $forum;
    }

    /**
     * Throw if the user is not allowed to post in the requested forum type.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    private function authorizeForumType(User $user, string $forumType): void
    {
        if ($forumType === Forum::TYPE_HEALER && ! $user->isPractitioner()) {
            throw new \Illuminate\Auth\Access\AuthorizationException(
                'Only verified healers can post in the Healers forum.'
            );
        }

        if ($forumType === Forum::TYPE_VENDOR && ! $user->is_vendor) {
            throw new \Illuminate\Auth\Access\AuthorizationException(
                'Only verified vendors can post in the Vendors forum.'
            );
        }
    }

    /**
     * Delete a forum (soft-delete). Only the author may delete their own forum.
     *
     * @throws \Exception
     */
    public function deleteForum(int $forumId, int $userId): void
    {
        $forum = Forum::findOrFail($forumId);

        if ($forum->author_id !== $userId) {
            throw new \Exception('Unauthorized to delete this forum');
        }

        $forum->delete();
    }

    public function forumExists(int $forumId): bool
    {
        return Forum::where('id', $forumId)->exists();
    }

    public function getForumById(int $forumId): Forum
    {
        return Forum::findOrFail($forumId);
    }
}
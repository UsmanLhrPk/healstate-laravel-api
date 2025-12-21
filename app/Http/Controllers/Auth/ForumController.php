<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Http\Requests\StoreForumRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Forum::with(['author:id,name,email'])
            ->withCount(['comments', 'likes', 'flags'])
            ->approved();

        // Filter by category
        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        // Filter by sub_category
        if ($request->has('sub_category')) {
            $query->bySubCategory($request->sub_category);
        }

        // Sort
        $sort = $request->input('sort', 'latest');
        if ($sort === 'popular') {
            $query->popular();
        } else {
            $query->latest();
        }

        $forums = $query->paginate(20);

        return response()->json($forums);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $userId = $request->user()?->id;

        $forum = Forum::with(['author:id,name,email'])
            ->withCount(['comments', 'likes', 'flags'])
            ->findOrFail($id);

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

        return response()->json([
            'forum' => $forum,
            'comments' => $comments,
        ]);
    }

    public function store(StoreForumRequest $request): JsonResponse
    {
        $forum = Forum::create([
            ...$request->validated(),
            'author_id' => $request->user()->id,
            'status' => 'approved',
        ]);

        $forum->load(['author:id,name,email']);

        return response()->json([
            'message' => 'Forum created successfully',
            'forum' => $forum,
        ], 201);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $forum = Forum::findOrFail($id);

        // Check if user is the author
        if ($forum->author_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized to delete this forum',
            ], 403);
        }

        $forum->delete();

        return response()->json([
            'message' => 'Forum deleted successfully',
        ]);
    }
}
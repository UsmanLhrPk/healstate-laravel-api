<?php

namespace App\Http\Controllers\Forums;

use App\Models\Forum;
use App\Http\Requests\Forums\StoreForumRequest;
use App\Services\ForumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    protected ForumService $forumService;

    public function __construct(ForumService $forumService)
    {
        $this->forumService = $forumService;
        // $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Get paginated list of forums
     * 
     * Query params:
     * - category: nullable
     * - sub_category: nullable
     * - sort: latest|popular (default: latest)
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'category' => 'nullable|string',
            'sub_category' => 'nullable|string',
            'sort' => 'nullable|in:latest,popular',
        ]);

        $forums = $this->forumService->getForums(
            category: $request->input('category'),
            subCategory: $request->input('sub_category'),
            sort: $request->input('sort', 'latest')
        );

        return response()->json($forums);
    }

    /**
     * Get single forum with comments
     */
    public function show(int $id): JsonResponse
    {
        $userId = auth()->id();

        $result = $this->forumService->getForumWithComments($id, $userId);

        return response()->json($result);
    }

    /**
     * Create a new forum
     */
    public function store(StoreForumRequest $request): JsonResponse
    {
        $forum = $this->forumService->createForum(
            $request->validated(),
            auth()->id()
        );

        return response()->json([
            'message' => 'Forum created successfully',
            'forum' => $forum->load(['author:id,name,email']),
        ], 201);
    }

    /**
     * Soft delete a forum (author only)
     */
    public function destroy(Request $request, int $id): JsonResponse
{
    $forum = Forum::findOrFail($id);

    if ($forum->author_id !== $request->user()->id) {
        return response()->json([
            'message' => 'Unauthorized. You can only delete your own forums.',
        ], 403);
    }

    $this->forumService->deleteForum($forum->id, $request->user()->id);

    return response()->json([
        'message' => 'Forum deleted successfully',
    ], 200);
}

}
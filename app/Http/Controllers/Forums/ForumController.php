<?php

namespace App\Http\Controllers\Forums;

use App\Models\Forum;
use App\Http\Requests\Forums\StoreForumRequest;
use App\Services\ForumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Forum Management
 *
 * APIs for managing community forums
 */
class ForumController extends Controller
{
    protected ForumService $forumService;

    public function __construct(ForumService $forumService)
    {
        $this->forumService = $forumService;
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * List all forums
     * 
     * Get a paginated list of all forums. Results can be filtered by category, sub-category, and sorted by latest or popularity.
     *
     * @queryParam category string Filter forums by category. Example: Mind
     * @queryParam sub_category string Filter forums by sub-category. Example: Mental Health
     * @queryParam sort string Sort forums by 'latest' or 'popular'. Defaults to 'latest'. Example: popular
     * @queryParam page integer The page number for pagination. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "How to improve mental clarity?",
     *       "content": "I've been struggling with focus lately...",
     *       "category": "Mind",
     *       "sub_category": "Mental Health",
     *       "author_id": 1,
     *       "status": "approved",
     *       "views": 125,
     *       "created_at": "2024-01-15T10:30:00.000000Z",
     *       "updated_at": "2024-01-15T10:30:00.000000Z",
     *       "author": {
     *         "id": 1,
     *         "name": "John Doe",
     *         "email": "john@example.com"
     *       },
     *       "comments_count": 5,
     *       "likes_count": 12,
     *       "flags_count": 0
     *     }
     *   ],
     *   "current_page": 1,
     *   "last_page": 5,
     *   "per_page": 20,
     *   "total": 100,
     *   "from": 1,
     *   "to": 20
     * }
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
     * Get a single forum
     * 
     * Retrieve detailed information about a specific forum including its comments. 
     * View count is automatically incremented for non-authors.
     *
     * @urlParam id integer required The ID of the forum. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "title": "How to improve mental clarity?",
     *   "content": "I've been struggling with focus lately. Has anyone tried meditation or nootropics?",
     *   "category": "Mind",
     *   "sub_category": "Mental Health",
     *   "author_id": 1,
     *   "status": "approved",
     *   "views": 126,
     *   "created_at": "2024-01-15T10:30:00.000000Z",
     *   "updated_at": "2024-01-15T10:30:00.000000Z",
     *   "author": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "email": "john@example.com"
     *   },
     *   "comments": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "comment": "I've had great success with daily meditation!",
     *         "author_id": 2,
     *         "created_at": "2024-01-15T11:00:00.000000Z",
     *         "author": {
     *           "id": 2,
     *           "name": "Jane Smith"
     *         },
     *         "likes_count": 3,
     *         "is_liked": false,
     *         "is_flagged": false,
     *         "replies_count": 2,
     *         "replies": []
     *       }
     *     ],
     *     "current_page": 1,
     *     "last_page": 1
     *   },
     *   "likes_count": 12,
     *   "flags_count": 0,
     *   "comments_count": 5,
     *   "is_liked": false,
     *   "is_flagged": false
     * }
     * 
     * @response 404 {
     *   "message": "Forum not found"
     * }
     */
    public function show(int $id): JsonResponse
    {
        $userId = auth()->id();

        $result = $this->forumService->getForumWithComments($id, $userId);

        return response()->json($result);
    }

    /**
     * Create a new forum
     * 
     * Create a new forum post. Requires authentication.
     *
     * @authenticated
     * 
     * @bodyParam title string required The forum title (max 400 characters). Example: How to improve mental clarity?
     * @bodyParam content string required The forum content/description. Example: I've been struggling with focus lately...
     * @bodyParam category string required The forum category. Must be one of: Mind, Body, Spirit, Biohacking, Frequency Healing, Holistic Health. Example: Mind
     * @bodyParam sub_category string required The forum sub-category. Example: Mental Health
     * 
     * @response 201 {
     *   "message": "Forum created successfully",
     *   "forum": {
     *     "id": 1,
     *     "title": "How to improve mental clarity?",
     *     "content": "I've been struggling with focus lately...",
     *     "category": "Mind",
     *     "sub_category": "Mental Health",
     *     "author_id": 1,
     *     "status": "approved",
     *     "views": 0,
     *     "created_at": "2024-01-15T10:30:00.000000Z",
     *     "updated_at": "2024-01-15T10:30:00.000000Z",
     *     "author": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "john@example.com"
     *     }
     *   }
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "title": ["The title field is required."],
     *     "category": ["The selected category is invalid."]
     *   }
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
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
     * Delete a forum
     * 
     * Soft delete a forum. Only the forum author can delete their own forum.
     *
     * @authenticated
     * 
     * @urlParam id integer required The ID of the forum to delete. Example: 1
     * 
     * @response 200 {
     *   "message": "Forum deleted successfully"
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized. You can only delete your own forums."
     * }
     * 
     * @response 404 {
     *   "message": "Forum not found"
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
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
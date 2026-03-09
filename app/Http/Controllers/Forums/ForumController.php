<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forums\StoreForumRequest;
use App\Models\Forum;
use App\Services\ForumService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Forum Management
 *
 * APIs for managing community forums. Forums are scoped by type:
 * - **general** — open to all authenticated users
 * - **healer**  — only verified practitioners may post (anyone can read)
 * - **vendor**  — only approved vendors may post (anyone can read)
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
     * List forums
     *
     * Returns a paginated list of approved forums. Supports filtering by
     * category, sub-category, and forum type, plus sorting by latest or popularity.
     *
     * @queryParam category     string  Filter by category. Must be one of: Mind, Body, Spirit, Biohacking, Frequency Healing, Holistic Health. Example: Mind
     * @queryParam sub_category string  Filter by sub-category (requires category to be set). Example: Mental Health
     * @queryParam forum_type   string  Filter by forum type. Must be one of: general, healer, vendor. Defaults to returning all types when omitted. Example: healer
     * @queryParam sort         string  Sort order. Must be one of: latest, popular. Defaults to latest. Example: popular
     * @queryParam page         integer Page number for pagination. Defaults to 1. Example: 1
     *
     * @response 200 {
     *   "current_page": 1,
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "How to improve mental clarity?",
     *       "content": "I've been struggling with focus lately...",
     *       "category": "Mind",
     *       "sub_category": "Mental Health",
     *       "forum_type": "general",
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
     *   "last_page": 5,
     *   "per_page": 10,
     *   "total": 50,
     *   "from": 1,
     *   "to": 10
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'category'     => 'nullable|string',
            'sub_category' => 'nullable|string',
            'forum_type'   => 'nullable|in:' . implode(',', Forum::TYPES),
            'sort'         => 'nullable|in:latest,popular',
        ]);

        $forums = $this->forumService->getForums(
            category:    $request->input('category'),
            subCategory: $request->input('sub_category'),
            forumType:   $request->input('forum_type'),
            sort:        $request->input('sort', 'latest'),
        );

        return response()->json($forums);
    }

    /**
     * Get a forum
     *
     * Returns a single forum with its paginated comments and reply previews.
     * The `is_liked` and `is_flagged` fields reflect the authenticated user's
     * state when a valid Sanctum token is provided; they default to `false`
     * for guests.
     *
     * @urlParam id integer required The ID of the forum. Example: 1
     *
     * @response 200 {
     *   "forum": {
     *     "id": 1,
     *     "title": "How to improve mental clarity?",
     *     "content": "I've been struggling with focus lately. Has anyone tried meditation or nootropics?",
     *     "category": "Mind",
     *     "sub_category": "Mental Health",
     *     "forum_type": "general",
     *     "author_id": 1,
     *     "status": "approved",
     *     "views": 126,
     *     "created_at": "2024-01-15T10:30:00.000000Z",
     *     "updated_at": "2024-01-15T10:30:00.000000Z",
     *     "author": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "john@example.com"
     *     },
     *     "comments_count": 5,
     *     "likes_count": 12,
     *     "flags_count": 0,
     *     "is_liked": false,
     *     "is_flagged": false
     *   },
     *   "comments": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "comment": "I've had great success with daily meditation!",
     *         "author_id": 2,
     *         "parent_id": null,
     *         "created_at": "2024-01-15T11:00:00.000000Z",
     *         "author": { "id": 2, "name": "Jane Smith" },
     *         "likes_count": 3,
     *         "replies_count": 2,
     *         "is_liked": false,
     *         "is_flagged": false,
     *         "recent_replies": []
     *       }
     *     ],
     *     "last_page": 1,
     *     "per_page": 10,
     *     "total": 5
     *   }
     * }
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Forum] 999"
     * }
     */
    public function show(string $id): JsonResponse
    {
        $userId  = optional(auth('sanctum')->user())->id;
        $forumId = (int) $id;

        $result = $this->forumService->getForumWithComments($forumId, $userId);

        return response()->json($result);
    }

    /**
     * Create a forum
     *
     * Creates a new forum post. The `forum_type` field controls who may post:
     * - `general` — any authenticated user
     * - `healer`  — requires the user to be a verified practitioner (`is_practitioner = true`)
     * - `vendor`  — requires the user to have an approved vendor account
     *
     * Attempting to post in a restricted type without the required role returns **403**.
     *
     * @authenticated
     *
     * @bodyParam title        string required Forum title. Max 400 characters. Example: How to improve mental clarity?
     * @bodyParam content      string required Forum body text. Example: I've been struggling with focus lately...
     * @bodyParam category     string required Must be one of: Mind, Body, Spirit, Biohacking, Frequency Healing, Holistic Health. Example: Mind
     * @bodyParam sub_category string required Sub-category matching the selected category. Example: Mental Health
     * @bodyParam forum_type   string required Must be one of: general, healer, vendor. Example: general
     *
     * @response 201 {
     *   "message": "Forum created successfully",
     *   "forum": {
     *     "id": 42,
     *     "title": "How to improve mental clarity?",
     *     "content": "I've been struggling with focus lately...",
     *     "category": "Mind",
     *     "sub_category": "Mental Health",
     *     "forum_type": "general",
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
     * @response 403 {
     *   "message": "Only verified healers can post in the Healers forum."
     * }
     * @response 403 {
     *   "message": "Only verified vendors can post in the Vendors forum."
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "title":      ["Forum title is required"],
     *     "category":   ["Please select a category"],
     *     "forum_type": ["Please select a forum type"]
     *   }
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(StoreForumRequest $request): JsonResponse
    {
        try {
            $forum = $this->forumService->createForum(
                $request->validated(),
                auth()->id()
            );
        } catch (AuthorizationException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }

        return response()->json([
            'message' => 'Forum created successfully',
            'forum'   => $forum->load(['author:id,name,email']),
        ], 201);
    }

    /**
     * Delete a forum
     *
     * Soft-deletes a forum. Only the original author may delete their own forum.
     * Deleted forums are not returned in any listing or detail endpoint.
     *
     * @authenticated
     *
     * @urlParam id integer required The ID of the forum to delete. Example: 1
     *
     * @response 200 {
     *   "message": "Forum deleted successfully"
     * }
     * @response 403 {
     *   "message": "Unauthorized. You can only delete your own forums."
     * }
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Forum] 999"
     * }
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

        return response()->json(['message' => 'Forum deleted successfully'], 200);
    }

    /**
     * Record a forum view
     *
     * Increments the view counter for a forum. Should be called by the frontend
     * after the user has actively read the forum for at least 30 seconds.
     * A per-user cooldown of **2 hours** is enforced via cache — repeated calls
     * within the cooldown window return **429** and do not increment the counter.
     *
     * @authenticated
     *
     * @urlParam id integer required The ID of the forum. Example: 1
     *
     * @response 200 {
     *   "message": "View recorded successfully",
     *   "views": 127
     * }
     * @response 429 {
     *   "message": "View not recorded - cooldown active",
     *   "views": 126
     * }
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Forum] 999"
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function recordView(Request $request, int $id): JsonResponse
    {
        $userId = $request->user()->id;
        $forum  = Forum::findOrFail($id);
        $recorded = $forum->recordView($userId);

        if ($recorded) {
            return response()->json([
                'message' => 'View recorded successfully',
                'views'   => $forum->fresh()->views,
            ]);
        }

        return response()->json([
            'message' => 'View not recorded - cooldown active',
            'views'   => $forum->views,
        ], 429);
    }
}
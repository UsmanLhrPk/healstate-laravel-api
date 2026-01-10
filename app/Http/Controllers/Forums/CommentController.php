<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forums\StoreCommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Comment Management
 *
 * APIs for managing comments on forums
 */
class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('auth:sanctum')->except(['index']);
    }

    /**
     * Get comments
     *
     * Retrieve comments for a commentable entity (e.g., Forum).
     * If parent_id is null, returns top-level comments with 3 most recent replies each (paginated 10 per page).
     * If parent_id is provided, returns all replies for that comment (paginated 10 per page).
     *
     * @queryParam commentable_type string required The type of entity being commented on. Example: App\Models\Forum
     * @queryParam commentable_id integer required The ID of the entity being commented on. Example: 1
     * @queryParam parent_id integer optional The parent comment ID (for fetching replies). Example: 5
     * @queryParam page integer optional The page number for pagination. Example: 1
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "comment": "Great post! I've been researching this topic too.",
     *       "author_id": 2,
     *       "commentable_type": "App\\Models\\Forum",
     *       "commentable_id": 1,
     *       "parent_id": null,
     *       "created_at": "2024-01-15T11:00:00.000000Z",
     *       "updated_at": "2024-01-15T11:00:00.000000Z",
     *       "deleted_at": null,
     *       "author": {
     *         "id": 2,
     *         "name": "Jane Smith",
     *         "email": "jane@example.com"
     *       },
     *       "likes_count": 3,
     *       "is_liked": false,
     *       "is_flagged": false,
     *       "replies_count": 2,
     *       "replies": [
     *         {
     *           "id": 3,
     *           "comment": "Thanks for sharing!",
     *           "author_id": 1,
     *           "parent_id": 1,
     *           "created_at": "2024-01-15T11:30:00.000000Z",
     *           "author": {
     *             "id": 1,
     *             "name": "John Doe"
     *           },
     *           "likes_count": 1
     *         }
     *       ]
     *     }
     *   ],
     *   "current_page": 1,
     *   "last_page": 1,
     *   "per_page": 10,
     *   "total": 5
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "commentable_type": ["The commentable type field is required."]
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
            'parent_id' => 'nullable|integer|exists:comments,id',
        ]);

        $commentableType = $request->input('commentable_type');
        $commentableId = $request->input('commentable_id');
        $parentId = $request->input('parent_id');

        // DEBUG: Log what the client sent
        \Log::info('Comment Index Request', [
            'commentable_type_raw' => $commentableType,
            'commentable_type_length' => strlen($commentableType),
            'commentable_type_hex' => bin2hex($commentableType),
            'commentable_id' => $commentableId,
        ]);

        // DEBUG: Check what's actually in the database for this ID
        $dbCheck = \DB::table('comments')
            ->where('commentable_id', $commentableId)
            ->whereNull('parent_id')
            ->select('commentable_type')
            ->distinct()
            ->get();

        \Log::info('Database has these types for ID '.$commentableId, [
            'types' => $dbCheck->pluck('commentable_type')->toArray(),
        ]);

        if ($parentId) {
            $replies = $this->commentService->getReplies($parentId);

            return response()->json($replies);
        }

        $comments = $this->commentService->getTopLevelComments($commentableType, $commentableId);

        // DEBUG: Log what we got back
        \Log::info('Comments returned', [
            'count' => $comments->total(),
        ]);

        return response()->json($comments);
    }

    /**
     * Create a comment
     *
     * Post a new comment on a forum or reply to an existing comment. Requires authentication.
     *
     * @authenticated
     *
     * @bodyParam comment string required The comment text. Example: I completely agree with this approach!
     * @bodyParam commentable_type string required The type of entity being commented on. Example: App\Models\Forum
     * @bodyParam commentable_id integer required The ID of the entity being commented on. Example: 1
     * @bodyParam parent_id integer optional The parent comment ID if this is a reply. Example: 5
     *
     * @response 201 {
     *   "message": "Comment created successfully",
     *   "comment": {
     *     "id": 10,
     *     "comment": "I completely agree with this approach!",
     *     "author_id": 2,
     *     "commentable_type": "App\\Models\\Forum",
     *     "commentable_id": 1,
     *     "parent_id": null,
     *     "created_at": "2024-01-15T12:00:00.000000Z",
     *     "updated_at": "2024-01-15T12:00:00.000000Z",
     *     "deleted_at": null,
     *     "author": {
     *       "id": 2,
     *       "name": "Jane Smith",
     *       "email": "jane@example.com"
     *     },
     *     "likes": [],
     *     "flags": []
     *   }
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "comment": ["The comment field is required."]
     *   }
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $comment = $this->commentService->createComment(
            $request->validated(),
            auth()->id()
        );

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment->load(['author', 'likes', 'flags']),
        ], 201);
    }

    /**
     * Delete a comment
     *
     * Soft delete a comment. Only the comment author can delete their own comment.
     *
     * @authenticated
     *
     * @urlParam id integer required The ID of the comment to delete. Example: 10
     *
     * @response 200 {
     *   "message": "Comment deleted successfully"
     * }
     * @response 403 {
     *   "message": "Unauthorized. You can only delete your own comments."
     * }
     * @response 404 {
     *   "message": "Comment not found"
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(int $id): JsonResponse
    {
        $comment = Comment::findOrFail($id);

        // Check if user is the author
        if ($comment->author_id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized. You can only delete your own comments.',
            ], 403);
        }

        $this->commentService->deleteComment($comment);

        return response()->json([
            'message' => 'Comment deleted successfully',
        ], 200);
    }
}

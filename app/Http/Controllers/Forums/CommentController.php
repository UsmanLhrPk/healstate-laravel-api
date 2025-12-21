<?php

namespace App\Http\Controllers\Forums;

use App\Http\Requests\Forums\StoreCommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        // $this->middleware('auth:sanctum')->except(['index']);
    }

    /**
     * Get comments for a commentable entity
     * 
     * Query params:
     * - commentable_type: required
     * - commentable_id: required
     * - parent_id: nullable (if null, returns top-level comments with 3 most recent replies each)
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

        if ($parentId) {
            // Return paginated replies for a specific comment (10 per page)
            $replies = $this->commentService->getReplies($parentId);
            return response()->json($replies);
        }

        // Return top-level comments with 3 most recent replies each (10 per page)
        $comments = $this->commentService->getTopLevelComments($commentableType, $commentableId);
        return response()->json($comments);
    }

    /**
     * Store a new comment
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
     * Soft delete a comment (author only)
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
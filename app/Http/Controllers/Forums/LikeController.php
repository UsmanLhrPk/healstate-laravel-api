<?php

namespace App\Http\Controllers\Forums;

use App\Http\Requests\Forums\ToggleLikeRequest;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

/**
 * @group Like Management
 *
 * APIs for liking/unliking forums and comments
 */
class LikeController extends Controller
{
    protected LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
        $this->middleware('auth:sanctum');
    }

    /**
     * Toggle like
     * 
     * Like or unlike a forum or comment. If the user has already liked the content, it will be unliked.
     * If the user hasn't liked it yet, a like will be created. Requires authentication.
     *
     * @authenticated
     * 
     * @bodyParam likeable_type string required The type of entity to like. Example: App\Models\Forum
     * @bodyParam likeable_id integer required The ID of the entity to like. Example: 1
     * 
     * @response 200 {
     *   "liked": true,
     *   "like_count": 13
     * }
     * 
     * @response 200 {
     *   "liked": false,
     *   "like_count": 12
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "likeable_type": ["The likeable type field is required."]
     *   }
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(ToggleLikeRequest $request): JsonResponse
    {
        $result = $this->likeService->toggleLike(
            $request->input('likeable_type'),
            $request->input('likeable_id'),
            auth()->id()
        );

        return response()->json([
            'liked' => $result['liked'],
            'like_count' => $result['like_count'],
        ], 200);
    }
}
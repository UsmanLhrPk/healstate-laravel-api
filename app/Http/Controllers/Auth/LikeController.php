<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleLikeRequest;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    protected LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
        $this->middleware('auth:sanctum');
    }

    /**
     * Toggle like on a likeable entity (Forum or Comment)
     * 
     * If like exists: delete it (unlike)
     * If like doesn't exist: create it
     * 
     * Returns: liked (boolean), like_count (integer)
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
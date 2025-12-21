<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlagContentRequest;
use App\Services\FlagService;
use Illuminate\Http\JsonResponse;

class FlagController extends Controller
{
    protected FlagService $flagService;

    public function __construct(FlagService $flagService)
    {
        $this->flagService = $flagService;
        $this->middleware('auth:sanctum');
    }

    /**
     * Flag content
     *
     * @param FlagContentRequest $request
     * @return JsonResponse
     */
    public function store(FlagContentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $this->flagService->flagContent(
                flaggableType: $validated['flaggable_type'],
                flaggableId: $validated['flaggable_id'],
                userId: $request->user()->id
            );

            return response()->json([
                'message' => 'Content flagged successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 409);
        }
    }

    /**
     * Unflag content (remove flag)
     *
     * @param FlagContentRequest $request
     * @return JsonResponse
     */
    public function destroy(FlagContentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $this->flagService->unflagContent(
                flaggableType: $validated['flaggable_type'],
                flaggableId: $validated['flaggable_id'],
                userId: $request->user()->id
            );

            return response()->json([
                'message' => 'Flag removed successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}

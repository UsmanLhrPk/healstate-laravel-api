<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forums\FlagContentRequest;
use App\Services\FlagService;
use Illuminate\Http\JsonResponse;

/**
 * @group Flag Management
 *
 * APIs for flagging inappropriate content
 */
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
     * Flag a forum or comment as inappropriate. A user can only flag the same content once. Requires authentication.
     *
     * @authenticated
     * 
     * @bodyParam flaggable_type string required The type of entity to flag. Example: App\Models\Forum
     * @bodyParam flaggable_id integer required The ID of the entity to flag. Example: 1
     * 
     * @response 201 {
     *   "message": "Content flagged successfully"
     * }
     * 
     * @response 409 {
     *   "message": "You have already flagged this content"
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "flaggable_type": ["The flaggable type field is required."]
     *   }
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
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
     * Remove flag
     * 
     * Remove a flag from previously flagged content. Requires authentication.
     *
     * @authenticated
     * 
     * @bodyParam flaggable_type string required The type of entity to unflag. Example: App\Models\Forum
     * @bodyParam flaggable_id integer required The ID of the entity to unflag. Example: 1
     * 
     * @response 200 {
     *   "message": "Flag removed successfully"
     * }
     * 
     * @response 404 {
     *   "message": "Flag not found"
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "flaggable_type": ["The flaggable type field is required."]
     *   }
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
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
                'message'=> 'Flag removed successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
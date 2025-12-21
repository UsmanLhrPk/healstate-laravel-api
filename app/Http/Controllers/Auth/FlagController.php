<?php

namespace App\Http\Controllers;

use App\Services\FlagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlagController extends Controller
{
    public function __construct(
        protected FlagService $flagService
    ) {}

    /**
     * Flag content
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'flaggable_type' => 'required|string',
                'flaggable_id' => 'required|integer',
            ]);

            $this->flagService->flagContent(
                flaggableType: $validated['flaggable_type'],
                flaggableId: $validated['flaggable_id'],
                userId: $request->user()->id
            );

            return response()->json([
                'message' => 'Content flagged successfully',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 409);
        }
    }
}
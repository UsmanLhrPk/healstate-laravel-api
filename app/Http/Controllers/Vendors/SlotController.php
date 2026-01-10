<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreSlotRequest;
use App\Http\Requests\Vendors\UpdateSlotRequest;
use App\Models\Product;
use App\Models\ServiceSlot;
use App\Services\SlotService;
use Illuminate\Http\JsonResponse;

/**
 * @group Service Slots
 * 
 * APIs for managing service time slots
 */
class SlotController extends Controller
{
    public function __construct(
        protected SlotService $slotService
    ) {}

    /**
     * Create Service Slot
     * 
     * Add a new time slot configuration for a service.
     * 
     * @authenticated
     * 
     * @urlParam product integer required The service product ID. Example: 1
     * 
     * @bodyParam duration integer required Slot duration in minutes. Example: 60
     * @bodyParam price number required Slot price. Example: 150.00
     * 
     * @response 201 {
     *   "message": "Service slot created successfully",
     *   "data": {
     *     "id": 1,
     *     "product_id": 1,
     *     "duration": 60,
     *     "price": "150.00",
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     */
    public function store(StoreSlotRequest $request, Product $product): JsonResponse
    {
        $slot = $this->slotService->createSlot(
            $product,
            $request->validated()
        );

        return response()->json([
            'message' => 'Service slot created successfully',
            'data' => $slot,
        ], 201);
    }

    /**
     * Update Service Slot
     * 
     * Update slot configuration. Only vendor owner can update.
     * 
     * @authenticated
     * 
     * @urlParam slot integer required The slot ID. Example: 1
     * 
     * @bodyParam duration integer optional Duration in minutes. Example: 90
     * @bodyParam price number optional Slot price. Example: 200.00
     * 
     * @response {
     *   "message": "Service slot updated successfully",
     *   "data": {
     *     "id": 1,
     *     "duration": 90,
     *     "price": "200.00",
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     */
    public function update(UpdateSlotRequest $request, ServiceSlot $slot): JsonResponse
    {
        $slot = $this->slotService->updateSlot(
            $slot,
            $request->validated()
        );

        return response()->json([
            'message' => 'Service slot updated successfully',
            'data' => $slot,
        ]);
    }

    /**
     * Delete Service Slot
     * 
     * Delete a service slot. Only vendor owner can delete.
     * 
     * @authenticated
     * 
     * @urlParam slot integer required The slot ID. Example: 1
     * 
     * @response {
     *   "message": "Service slot deleted successfully"
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function destroy(ServiceSlot $slot): JsonResponse
    {
        $this->authorize('delete', $slot);
        
        $this->slotService->deleteSlot($slot);

        return response()->json([
            'message' => 'Service slot deleted successfully',
        ]);
    }
}
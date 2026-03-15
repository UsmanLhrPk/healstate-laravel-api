<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practitioners\StorePractitionerOfferingAvailabilityRequest;
use App\Http\Resources\AvailabilityScheduleResource;
use App\Models\PractitionerOfferingSlot;
use App\Services\PractitionerOfferingAvailabilityService;
use Illuminate\Http\JsonResponse;

class PractitionerOfferingAvailabilityController extends Controller
{
    public function __construct(protected PractitionerOfferingAvailabilityService $availabilityService) {}

    public function store(StorePractitionerOfferingAvailabilityRequest $request, PractitionerOfferingSlot $slot): JsonResponse
    {
        if (! $this->userOwnsSlot($slot)) return response()->json(['message' => 'Unauthorized'], 403);

        try {
            $schedule = $this->availabilityService->storeSchedule($slot, $request->validated()['schedule']);
            return response()->json([
                'message'  => 'Availability schedule saved successfully',
                'schedule' => AvailabilityScheduleResource::collection(collect($schedule)),
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to save availability schedule', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(PractitionerOfferingSlot $slot): JsonResponse
    {
        if (! $this->userOwnsSlot($slot)) return response()->json(['message' => 'Unauthorized'], 403);

        try {
            $schedule = $this->availabilityService->getSchedule($slot);
            return response()->json(['schedule' => AvailabilityScheduleResource::collection(collect($schedule))]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to load availability schedule', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(PractitionerOfferingSlot $slot): JsonResponse
    {
        if (! $this->userOwnsSlot($slot)) return response()->json(['message' => 'Unauthorized'], 403);

        try {
            $this->availabilityService->deleteSchedule($slot);
            return response()->json(['message' => 'Availability schedule deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete availability schedule', 'error' => $e->getMessage()], 500);
        }
    }

    private function userOwnsSlot(PractitionerOfferingSlot $slot): bool
    {
        return $slot->offering->practitionerProfile->user_id === auth()->id();
    }
}

<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreAvailabilityRequest;
use App\Http\Resources\AvailabilityScheduleResource;
use App\Models\ServiceSlot;
use App\Services\AvailabilityService;
use Illuminate\Http\JsonResponse;

/**
 * @group Service Availability Management
 * 
 * APIs for managing service slot availability schedules. Vendors can set their weekly availability 
 * (days and time ranges) for each service slot.
 */
class AvailabilityController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    /**
     * Store Availability Schedule
     * 
     * Set or update the weekly availability schedule for a service slot. This defines which days and times 
     * the vendor is available for bookings. The schedule will replace any existing schedule for the slot.
     * 
     * @authenticated
     * 
     * @urlParam slot integer required The ID of the service slot. Example: 1
     * 
     * @bodyParam schedule array required Array of weekly schedule data. Must contain 7 elements (one for each day).
     * @bodyParam schedule[].day_of_week integer required Day of the week (0=Sunday, 1=Monday, ..., 6=Saturday). Example: 1
     * @bodyParam schedule[].is_available boolean required Whether the vendor is available on this day. Example: true
     * @bodyParam schedule[].time_slots array optional Array of time slots for the day. Required if is_available is true.
     * @bodyParam schedule[].time_slots[].start_time string required Start time in HH:MM format (24-hour). Example: 09:00
     * @bodyParam schedule[].time_slots[].end_time string required End time in HH:MM format (24-hour). Must be after start_time. Example: 17:00
     * 
     * @response 200 {
     *   "message": "Availability schedule saved successfully",
     *   "schedule": [
     *     {
     *       "day_of_week": 0,
     *       "is_available": false,
     *       "time_slots": []
     *     },
     *     {
     *       "day_of_week": 1,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "12:00"
     *         },
     *         {
     *           "start_time": "14:00",
     *           "end_time": "18:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 2,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 3,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 4,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 5,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 6,
     *       "is_available": false,
     *       "time_slots": []
     *     }
     *   ]
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "schedule.0.day_of_week": ["The schedule.0.day_of_week field is required."],
     *     "schedule.0.time_slots.0.end_time": ["The schedule.0.time_slots.0.end_time must be after schedule.0.time_slots.0.start_time."]
     *   }
     * }
     * 
     * @response 500 {
     *   "message": "Failed to save availability schedule",
     *   "error": "Database error message"
     * }
     */
    public function store(StoreAvailabilityRequest $request, ServiceSlot $slot): JsonResponse
    {
        // Check authorization - user must own the vendor
        $vendor = $slot->product->vendor;
        if ($vendor->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $schedule = $this->availabilityService->storeSchedule(
                $slot,
                $request->validated()['schedule']
            );

            return response()->json([
                'message' => 'Availability schedule saved successfully',
                'schedule' => AvailabilityScheduleResource::collection(collect($schedule))
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to save availability schedule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Availability Schedule
     * 
     * Retrieve the weekly availability schedule for a service slot. Returns the days and times when 
     * the vendor is available for bookings. Used by vendors to view/edit their schedule.
     * 
     * @authenticated
     * 
     * @urlParam slot integer required The ID of the service slot. Example: 1
     * 
     * @response 200 {
     *   "schedule": [
     *     {
     *       "day_of_week": 0,
     *       "is_available": false,
     *       "time_slots": []
     *     },
     *     {
     *       "day_of_week": 1,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "12:00"
     *         },
     *         {
     *           "start_time": "14:00",
     *           "end_time": "18:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 2,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 3,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 4,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 5,
     *       "is_available": true,
     *       "time_slots": [
     *         {
     *           "start_time": "09:00",
     *           "end_time": "17:00"
     *         }
     *       ]
     *     },
     *     {
     *       "day_of_week": 6,
     *       "is_available": false,
     *       "time_slots": []
     *     }
     *   ]
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     * 
     * @response 404 {
     *   "message": "Service slot not found"
     * }
     * 
     * @response 500 {
     *   "message": "Failed to load availability schedule",
     *   "error": "Error message"
     * }
     */
    public function show(ServiceSlot $slot): JsonResponse
    {
        // Check authorization - user must own the vendor
        $vendor = $slot->product->vendor;
        if ($vendor->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $schedule = $this->availabilityService->getSchedule($slot);

            return response()->json([
                'schedule' => AvailabilityScheduleResource::collection(collect($schedule))
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load availability schedule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete Availability Schedule
     * 
     * Remove all availability schedule data for a service slot. After deletion, the slot will have 
     * no defined availability and customers won't be able to book it until a new schedule is set.
     * 
     * @authenticated
     * 
     * @urlParam slot integer required The ID of the service slot. Example: 1
     * 
     * @response 200 {
     *   "message": "Availability schedule deleted successfully"
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     * 
     * @response 404 {
     *   "message": "Service slot not found"
     * }
     * 
     * @response 500 {
     *   "message": "Failed to delete availability schedule",
     *   "error": "Error message"
     * }
     */
    public function destroy(ServiceSlot $slot): JsonResponse
    {
        // Check authorization - user must own the vendor
        $vendor = $slot->product->vendor;
        if ($vendor->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $this->availabilityService->deleteSchedule($slot);

            return response()->json([
                'message' => 'Availability schedule deleted successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete availability schedule',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
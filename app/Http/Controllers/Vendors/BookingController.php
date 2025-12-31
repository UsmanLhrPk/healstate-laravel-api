<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreBookingRequest;
use App\Models\ServiceBooking;
use App\Models\ServiceSlot;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Service Bookings
 * 
 * APIs for managing service bookings and availability
 */
class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    /**
     * Check Slot Availability
     * 
     * Get available and booked time slots for a date range.
     * 
     * @urlParam slot integer required The service slot ID. Example: 1
     * 
     * @queryParam start_date date required Start date (YYYY-MM-DD). Example: 2024-01-01
     * @queryParam end_date date required End date (YYYY-MM-DD). Example: 2024-01-07
     * 
     * @response {
     *   "data": {
     *     "2024-01-01": {
     *       "date": "2024-01-01",
     *       "booked_slots": [
     *         {
     *           "start_time": "09:00:00",
     *           "end_time": "10:00:00"
     *         },
     *         {
     *           "start_time": "14:00:00",
     *           "end_time": "15:00:00"
     *         }
     *       ]
     *     },
     *     "2024-01-02": {
     *       "date": "2024-01-02",
     *       "booked_slots": []
     *     }
     *   }
     * }
     */
    public function availability(Request $request, ServiceSlot $slot): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        try {
            $availability = $this->availabilityService->getAvailableSlots(
                $slot,
                $request->start_date,
                $request->end_date
            );

            return response()->json($availability, 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load availability',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Create Booking
     * 
     * Book a service time slot. Prevents overlapping bookings.
     * 
     * @authenticated
     * 
     * @bodyParam service_slot_id integer required The service slot ID. Example: 1
     * @bodyParam booking_date date required Booking date (YYYY-MM-DD). Example: 2024-01-15
     * @bodyParam start_time string required Start time (HH:MM:SS). Example: 10:00:00
     * @bodyParam end_time string required End time (HH:MM:SS). Example: 11:00:00
     * 
     * @response 201 {
     *   "message": "Booking created successfully",
     *   "data": {
     *     "id": 1,
     *     "service_slot_id": 1,
     *     "user_id": 1,
     *     "booking_date": "2024-01-15",
     *     "start_time": "10:00:00",
     *     "end_time": "11:00:00",
     *     "status": "pending",
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     * 
     * @response 422 {
     *   "message": "Time slot is already booked"
     * }
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        try {
            $booking = $this->bookingService->createBooking(
                auth()->id(),
                $request->validated()
            );

            return response()->json([
                'message' => 'Booking created successfully',
                'data' => $booking,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * List User Bookings
     * 
     * Get all bookings for the authenticated user with pagination.
     * 
     * @authenticated
     * 
     * @queryParam page integer Page number. Example: 1
     * @queryParam per_page integer Items per page (max 100). Example: 15
     * 
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "service_slot_id": 1,
     *       "booking_date": "2024-01-15",
     *       "start_time": "10:00:00",
     *       "end_time": "11:00:00",
     *       "status": "confirmed",
     *       "service_slot": {
     *         "id": 1,
     *         "duration": 60,
     *         "price": "150.00",
     *         "product": {
     *           "id": 1,
     *           "title": "Web Development Consultation",
     *           "vendor": {
     *             "id": 1,
     *             "business_name": "Tech Solutions Inc"
     *           }
     *         }
     *       }
     *     }
     *   ],
     *   "links": {
     *     "first": "http://localhost/api/bookings?page=1",
     *     "last": "http://localhost/api/bookings?page=2",
     *     "prev": null,
     *     "next": "http://localhost/api/bookings?page=2"
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 2,
     *     "per_page": 15,
     *     "to": 15,
     *     "total": 28
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min($request->input('per_page', 15), 100);
        $bookings = $this->bookingService->getUserBookings(auth()->id(), $perPage);

        return response()->json($bookings);
    }

    /**
     * Cancel Booking
     * 
     * Cancel a booking. Only the booking owner can cancel.
     * 
     * @authenticated
     * 
     * @urlParam booking integer required The booking ID. Example: 1
     * 
     * @response {
     *   "message": "Booking cancelled successfully",
     *   "data": {
     *     "id": 1,
     *     "status": "cancelled",
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function cancel(ServiceBooking $booking): JsonResponse
    {
        $this->authorize('cancel', $booking);
        
        $booking = $this->bookingService->cancelBooking($booking);

        return response()->json([
            'message' => 'Booking cancelled successfully',
            'data' => $booking,
        ]);
    }
}
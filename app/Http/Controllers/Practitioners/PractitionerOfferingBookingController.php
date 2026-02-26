<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practitioners\StorePractitionerOfferingBookingRequest;
use App\Http\Resources\Practitioners\PractitionerOfferingBookingResource;
use App\Models\PractitionerOfferingBooking;
use App\Models\PractitionerOfferingSlot;
use App\Services\PractitionerOfferingAvailabilityService;
use App\Services\PractitionerOfferingBookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PractitionerOfferingBookingController extends Controller
{
    public function __construct(
        protected PractitionerOfferingBookingService $bookingService,
        protected PractitionerOfferingAvailabilityService $availabilityService
    ) {}

    public function availability(Request $request, PractitionerOfferingSlot $slot): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        try {
            // Fetch all non-cancelled bookings for this slot in the date range
            $bookings = PractitionerOfferingBooking::where('practitioner_offering_slot_id', $slot->id)
                ->whereBetween('booking_date', [$request->start_date, $request->end_date])
                ->whereNotIn('status', ['cancelled'])
                ->get(['booking_date', 'start_time', 'status']);

            // Return in the format the frontend expects: { booked: ["YYYY-MM-DDTHH:MM", ...] }
            $booked = $bookings->map(function ($b) {
                // booking_date is cast to Carbon in the model, always use format()
                $date = $b->booking_date->format('Y-m-d');
                $time = substr($b->start_time, 0, 5);

                return "{$date}T{$time}";
            });

            return response()->json(['booked' => $booked->values()]);

        } catch (\Exception $e) {
            return response()->json(['booked' => []]);
        }
    }

    public function store(StorePractitionerOfferingBookingRequest $request): JsonResponse
    {
        try {
            $booking = $this->bookingService->createBooking(auth()->id(), $request->validated());

            return response()->json([
                'message' => 'Booking created successfully',
                'data' => new PractitionerOfferingBookingResource($booking),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = min($request->input('per_page', 15), 100);
        $bookings = $this->bookingService->getUserBookings(auth()->id(), $perPage);

        return response()->json($bookings);
    }

    public function practitionerIndex(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }
        $perPage = min($request->input('per_page', 15), 100);
        $bookings = $this->bookingService->getPractitionerBookings($profile->id, $perPage);

        return response()->json($bookings);
    }

    public function cancel(PractitionerOfferingBooking $booking): JsonResponse
    {
        $this->authorize('cancel', $booking);
        $booking = $this->bookingService->cancelBooking($booking);

        return response()->json([
            'message' => 'Booking cancelled successfully',
            'data' => new PractitionerOfferingBookingResource($booking),
        ]);
    }
}

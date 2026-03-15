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
            'end_date'   => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        try {
            $bookings = PractitionerOfferingBooking::where('practitioner_offering_slot_id', $slot->id)
                ->whereBetween('booking_date', [$request->start_date, $request->end_date])
                ->whereNotIn('status', ['cancelled'])
                ->get(['booking_date', 'start_time', 'status']);

            $booked = $bookings->map(function ($b) {
                $date = $b->booking_date instanceof \Carbon\Carbon
                    ? $b->booking_date->format('Y-m-d')
                    : substr($b->booking_date, 0, 10);
                $time = substr($b->start_time, 0, 5);
                return "{$date}T{$time}";
            });

            return response()->json(['booked' => $booked->values()]);
        } catch (\Exception $e) {
            return response()->json(['booked' => [], 'debug_error' => $e->getMessage()]);
        }
    }

    public function store(StorePractitionerOfferingBookingRequest $request): JsonResponse
    {
        try {
            $booking = $this->bookingService->createBooking(auth()->id(), $request->validated());

            return response()->json([
                'message' => 'Booking created successfully',
                'data'    => new PractitionerOfferingBookingResource($booking),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function index(Request $request): JsonResponse
{
    $perPage  = min($request->input('per_page', 15), 100);
    $status   = $request->query('status');
    $bookings = $this->bookingService->getUserBookings(auth()->id(), $perPage, $status);

    return response()->json($bookings);
}

    public function practitionerIndex(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }
        $status  = $request->query('status');
        $perPage = min($request->input('per_page', 15), 100);
        $bookings = $this->bookingService->getPractitionerBookings($profile->id, $perPage, $status);

        return response()->json($bookings);
    }

    public function cancel(PractitionerOfferingBooking $booking): JsonResponse
    {
        $this->authorize('cancel', $booking);
        $booking = $this->bookingService->cancelBooking($booking);

        return response()->json([
            'message' => 'Booking cancelled successfully',
            'data'    => new PractitionerOfferingBookingResource($booking),
        ]);
    }

    // ── Healer: approve a customer cancellation request ──────────────────────

    public function approveCancellation(PractitionerOfferingBooking $booking): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }

        if ($booking->slot->offering->practitioner_profile_id !== $profile->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($booking->status !== 'cancellation_requested') {
            return response()->json(['message' => 'No pending cancellation request for this booking'], 422);
        }

        $booking = $this->bookingService->approveCancellation($booking);

        return response()->json([
            'message' => 'Cancellation approved successfully',
            'data'    => new PractitionerOfferingBookingResource($booking),
        ]);
    }

    // ── Healer: deny a customer cancellation request ─────────────────────────

    public function denyCancellation(PractitionerOfferingBooking $booking, Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }

        if ($booking->slot->offering->practitioner_profile_id !== $profile->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($booking->status !== 'cancellation_requested') {
            return response()->json(['message' => 'No pending cancellation request for this booking'], 422);
        }

        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $booking = $this->bookingService->denyCancellation($booking, $validated['reason'] ?? null);

        return response()->json([
            'message' => 'Cancellation request denied',
            'data'    => new PractitionerOfferingBookingResource($booking),
        ]);
    }

    // ── Customer: request cancellation ───────────────────────────────────────

    public function requestCancellation(PractitionerOfferingBooking $booking, Request $request): JsonResponse
    {
        if ($booking->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (! in_array($booking->status, ['pending', 'confirmed'])) {
            return response()->json(['message' => 'Booking cannot be cancelled at this time'], 422);
        }

        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $booking = $this->bookingService->requestCancellation($booking, $validated['reason'] ?? null);

        return response()->json([
            'message' => 'Cancellation request submitted successfully',
            'data'    => new PractitionerOfferingBookingResource($booking),
        ]);
    }
}
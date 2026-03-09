<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Services\PractitionerAvailabilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PractitionerAvailabilityController extends Controller
{
    public function __construct(
        protected PractitionerAvailabilityService $availabilityService
    ) {}

    // ─── GET /availability ───────────────────────────────────────────────────

    public function index(): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) return response()->json(['message' => 'Practitioner profile not found'], 404);

        $blocks = $this->availabilityService->getUpcomingSchedule($profile);
        return response()->json(['data' => $blocks]);
    }

    // ─── POST /availability/repeat ───────────────────────────────────────────

    public function repeat(): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) return response()->json(['message' => 'Practitioner profile not found'], 404);

        try {
            $block = $this->availabilityService->repeat($profile);
            return response()->json(['message' => 'Schedule repeated successfully', 'data' => $block], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    // ─── GET /availability/check-skip?date=YYYY-MM-DD ────────────────────────
    // Frontend calls this BEFORE confirming skip, to show how many bookings get cancelled.

    public function checkSkip(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) return response()->json(['message' => 'Practitioner profile not found'], 404);

        $request->validate(['date' => 'required|date_format:Y-m-d']);
        $date = $request->input('date');

        $targetDate = \Carbon\Carbon::parse($date)->startOfDay();
        $cutoff     = \Carbon\Carbon::now()->addHours(24);

        if ($targetDate->lessThan($cutoff)) {
            return response()->json([
                'can_skip'          => false,
                'reason'            => 'This date is within 24 hours and cannot be skipped.',
                'affected_bookings' => 0,
            ]);
        }

        $affected = $this->availabilityService->getAffectedBookingsCount($profile, $date);

        return response()->json([
            'can_skip'          => true,
            'affected_bookings' => $affected,
            'date'              => $date,
        ]);
    }

    // ─── POST /availability/skip ─────────────────────────────────────────────

    public function skip(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) return response()->json(['message' => 'Practitioner profile not found'], 404);

        $validated = $request->validate([
            'date'   => 'required|date_format:Y-m-d',
            'reason' => 'required|string|min:10|max:500',
        ]);

        try {
            $result = $this->availabilityService->skipDate(
                $profile,
                $validated['date'],
                $validated['reason'],
            );
            return response()->json([
                'message'            => 'Date skipped successfully',
                'data'               => $result['schedule'],
                'cancelled_bookings' => $result['cancelled_bookings'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    // ─── DELETE /availability/skip ───────────────────────────────────────────

    public function unskip(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) return response()->json(['message' => 'Practitioner profile not found'], 404);

        $validated = $request->validate(['date' => 'required|date_format:Y-m-d']);

        try {
            $block = $this->availabilityService->unskipDate($profile, $validated['date']);
            return response()->json(['message' => 'Date restored successfully', 'data' => $block]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    // ─── PUT /availability/pattern ───────────────────────────────────────────
    // Update the weekly pattern (days + hours) across all future blocks.
    // Bookings on days/times that are removed get cancelled + refunded + emailed.

    public function updatePattern(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) return response()->json(['message' => 'Practitioner profile not found'], 404);

        $validated = $request->validate([
            'pattern'          => 'required|array',
            'pattern.*.is_available'          => 'required|boolean',
            'pattern.*.time_slots'            => 'array',
            'pattern.*.time_slots.*.start_time' => 'required_if:pattern.*.is_available,true|date_format:H:i',
            'pattern.*.time_slots.*.end_time'   => 'required_if:pattern.*.is_available,true|date_format:H:i',
            'pattern.*.slot_duration_minutes' => 'sometimes|integer|min:15',
            'reason' => 'required|string|min:10|max:500',
        ]);

        try {
            $result = $this->availabilityService->updatePattern(
                $profile,
                $validated['pattern'],
                $validated['reason'],
            );
            return response()->json([
                'message'            => "Schedule updated across {$result['updated_blocks']} block(s).",
                'updated_blocks'     => $result['updated_blocks'],
                'cancelled_bookings' => $result['cancelled_bookings'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
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

    /**
     * GET /practitioners/availability
     * Returns all schedule blocks for the authenticated healer.
     */
    public function index(): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }

        $schedule = $this->availabilityService->getUpcomingSchedule($profile);

        return response()->json([
            'data' => $schedule->map(fn ($block) => $this->formatBlock($block)),
        ]);
    }

    /**
     * POST /practitioners/availability/repeat
     * Appends a new week block after the last existing one.
     */
    public function repeat(): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }

        try {
            $block = $this->availabilityService->repeat($profile);

            return response()->json([
                'message' => 'Schedule repeated successfully.',
                'data'    => $this->formatBlock($block),
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * POST /practitioners/availability/skip
     * Body: { "date": "Y-m-d" }
     * Skips a specific date from the schedule.
     */
    public function skip(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }

        $validated = $request->validate([
            'date' => ['required', 'date_format:Y-m-d'],
        ]);

        try {
            $this->availabilityService->skipDate($profile, $validated['date']);

            return response()->json([
                'message' => "Date {$validated['date']} skipped successfully.",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * DELETE /practitioners/availability/skip
     * Body: { "date": "Y-m-d" }
     * Removes a skip from a specific date.
     */
    public function unskip(Request $request): JsonResponse
    {
        $profile = auth()->user()->practitionerProfile;
        if (! $profile) {
            return response()->json(['message' => 'Practitioner profile not found'], 404);
        }

        $validated = $request->validate([
            'date' => ['required', 'date_format:Y-m-d'],
        ]);

        try {
            $this->availabilityService->unskipDate($profile, $validated['date']);

            return response()->json([
                'message' => "Skip removed for {$validated['date']}.",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    // ── Private Helpers ────────────────────────────────────────────────────────

    private function formatBlock($block): array
    {
        return [
            'id'              => $block->id,
            'week_start_date' => $block->week_start_date->format('Y-m-d'),
            'week_end_date'   => $block->week_end_date->format('Y-m-d'),
            'weekly_pattern'  => $block->weekly_pattern,
            'is_active'       => $block->is_active,
            'skipped_dates'   => $block->skipped_dates ?? [],
            'source'          => $block->source,
            'created_at'      => $block->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
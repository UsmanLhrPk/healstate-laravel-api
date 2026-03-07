<?php

namespace App\Services;

use App\Models\PractitionerAvailabilitySchedule;
use App\Models\PractitionerProfile;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PractitionerAvailabilityService
{
    // ── Schedule Creation ──────────────────────────────────────────────────────

    /**
     * Create the initial availability schedule from an approved application.
     *
     * The application's weekly_pattern is used to seed TWO week blocks:
     *   - Week 1: from the application's start_date (or next Monday) for the pattern duration
     *   - Week 2: immediately after Week 1, same pattern, same duration
     *
     * If the application used "weekly" (recurring) mode with no date range,
     * we default to a 1-week block starting from the next Monday.
     */
    public function createFromApplication(PractitionerProfile $profile, array $availabilitySchedule): void
    {
        DB::transaction(function () use ($profile, $availabilitySchedule) {
            // Delete any existing schedule for this profile (re-approval scenario)
            PractitionerAvailabilitySchedule::where('practitioner_profile_id', $profile->id)->delete();

            $pattern   = $availabilitySchedule['days'] ?? [];
            $schedType = $availabilitySchedule['schedule_type'] ?? 'weekly';

            // Determine week 1 start/end
            if ($schedType === 'date_range' && ! empty($availabilitySchedule['start_date'])) {
                $week1Start = Carbon::parse($availabilitySchedule['start_date'])->startOfDay();
                $week1End   = Carbon::parse($availabilitySchedule['end_date'])->startOfDay();
            } else {
                // Default: start from next Monday, run 1 week
                $week1Start = Carbon::now()->next(Carbon::MONDAY)->startOfDay();
                $week1End   = $week1Start->copy()->addDays(6);
            }

            $durationDays = $week1Start->diffInDays($week1End); // e.g. 6 for a 7-day range

            // Week 2 starts the day after week 1 ends
            $week2Start = $week1End->copy()->addDay();
            $week2End   = $week2Start->copy()->addDays($durationDays);

            // Create week 1
            PractitionerAvailabilitySchedule::create([
                'practitioner_profile_id' => $profile->id,
                'week_start_date'         => $week1Start->format('Y-m-d'),
                'week_end_date'           => $week1End->format('Y-m-d'),
                'weekly_pattern'          => $pattern,
                'is_active'               => true,
                'skipped_dates'           => [],
                'source'                  => 'application',
            ]);

            // Create week 2 (the automatic duplicate)
            PractitionerAvailabilitySchedule::create([
                'practitioner_profile_id' => $profile->id,
                'week_start_date'         => $week2Start->format('Y-m-d'),
                'week_end_date'           => $week2End->format('Y-m-d'),
                'weekly_pattern'          => $pattern,
                'is_active'               => true,
                'skipped_dates'           => [],
                'source'                  => 'application',
            ]);
        });
    }

    // ── Repeat ─────────────────────────────────────────────────────────────────

    /**
     * Append a new week block after the last existing one, using the same pattern.
     * The new block has the same duration as the most recent block.
     */
    public function repeat(PractitionerProfile $profile): PractitionerAvailabilitySchedule
    {
        $last = PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->orderByDesc('week_end_date')
            ->firstOrFail();

        $durationDays = $last->week_start_date->diffInDays($last->week_end_date);
        $newStart     = $last->week_end_date->copy()->addDay();
        $newEnd       = $newStart->copy()->addDays($durationDays);

        return PractitionerAvailabilitySchedule::create([
            'practitioner_profile_id' => $profile->id,
            'week_start_date'         => $newStart->format('Y-m-d'),
            'week_end_date'           => $newEnd->format('Y-m-d'),
            'weekly_pattern'          => $last->weekly_pattern,
            'is_active'               => true,
            'skipped_dates'           => [],
            'source'                  => 'repeat',
        ]);
    }

    // ── Skip / Unskip ──────────────────────────────────────────────────────────

    /**
     * Skip a specific date. Finds the week block covering that date and adds it.
     */
    public function skipDate(PractitionerProfile $profile, string $date): void
    {
        $block = $this->getBlockForDate($profile->id, $date);

        if (! $block) {
            throw new \Exception("No availability schedule found covering {$date}.");
        }

        $block->skipDate($date);
    }

    /**
     * Unskip a specific date.
     */
    public function unskipDate(PractitionerProfile $profile, string $date): void
    {
        $block = $this->getBlockForDate($profile->id, $date);

        if (! $block) {
            throw new \Exception("No availability schedule found covering {$date}.");
        }

        $block->unskipDate($date);
    }

    // ── Availability Check ─────────────────────────────────────────────────────

    /**
     * Check whether a healer is available on a specific date and time range.
     * Used by the booking service before creating a booking.
     *
     * @param  int    $profileId        practitioner_profile_id
     * @param  string $date             Y-m-d
     * @param  string $startTime        H:i or H:i:s
     * @param  string $endTime          H:i or H:i:s
     */
    public function isAvailable(int $profileId, string $date, string $startTime, string $endTime): bool
    {
        $block = $this->getBlockForDate($profileId, $date);

        if (! $block) return false;

        $daySchedule = $block->getDaySchedule($date);

        if (! $daySchedule) return false;

        // Check whether the requested time falls within any of the day's time slots
        $start = Carbon::parse($startTime);
        $end   = Carbon::parse($endTime);

        foreach ($daySchedule['time_slots'] as $ts) {
            $slotStart = Carbon::parse($ts['start_time']);
            $slotEnd   = Carbon::parse($ts['end_time']);

            if ($start->gte($slotStart) && $end->lte($slotEnd)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all available time slots for a healer on a given date.
     * Used by the offering availability service to filter slots.
     *
     * Returns array of ["HH:MM", "HH:MM"] start times that are available,
     * or null if the healer has no schedule covering that date.
     */
    public function getAvailableTimesForDate(int $profileId, string $date): ?array
    {
        $block = $this->getBlockForDate($profileId, $date);

        if (! $block) return null;

        $daySchedule = $block->getDaySchedule($date);

        if (! $daySchedule) return []; // healer is explicitly unavailable this day

        return $daySchedule['time_slots'] ?? [];
    }

    // ── Schedule Listing ───────────────────────────────────────────────────────

    /**
     * Get all schedule blocks for a profile, ordered by start date.
     */
    public function getSchedule(PractitionerProfile $profile): Collection
    {
        return PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->orderBy('week_start_date')
            ->get();
    }

    /**
     * Get the current and future schedule blocks.
     */
    public function getUpcomingSchedule(PractitionerProfile $profile): Collection
    {
        return PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->where('week_end_date', '>=', now()->format('Y-m-d'))
            ->orderBy('week_start_date')
            ->get();
    }

    // ── Private Helpers ────────────────────────────────────────────────────────

    private function getBlockForDate(int $profileId, string $date): ?PractitionerAvailabilitySchedule
    {
        return PractitionerAvailabilitySchedule::forProfile($profileId)
            ->active()
            ->coveringDate($date)
            ->first();
    }
}
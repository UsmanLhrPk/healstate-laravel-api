<?php

namespace App\Services;

use App\Models\PractitionerOfferingAvailability;
use App\Models\PractitionerOfferingBooking;
use App\Models\PractitionerOfferingSlot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PractitionerOfferingAvailabilityService
{
    public function __construct(
        protected PractitionerAvailabilityService $healerAvailabilityService
    ) {}

    public function storeSchedule(PractitionerOfferingSlot $slot, array $scheduleData): array
    {
        DB::beginTransaction();
        try {
            PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slot->id)->delete();

            foreach ($scheduleData as $day) {
                if ($day['is_available'] && ! empty($day['time_slots'])) {
                    foreach ($day['time_slots'] as $ts) {
                        PractitionerOfferingAvailability::create([
                            'practitioner_offering_slot_id' => $slot->id,
                            'day_of_week'                   => $day['day_of_week'],
                            'start_time'                    => $ts['start_time'],
                            'end_time'                      => $ts['end_time'],
                        ]);
                    }
                }
            }

            DB::commit();
            return $this->getSchedule($slot);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getSchedule(PractitionerOfferingSlot $slot): array
    {
        $availability = PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slot->id)
            ->orderBy('day_of_week')->orderBy('start_time')->get();

        $schedule = [];
        for ($day = 0; $day <= 6; $day++) {
            $daySlots = $availability->where('day_of_week', $day);
            $schedule[] = [
                'day_of_week'  => $day,
                'is_available' => $daySlots->isNotEmpty(),
                'time_slots'   => $daySlots->map(fn ($a) => [
                    'start_time' => substr($a->start_time, 0, 5),
                    'end_time'   => substr($a->end_time, 0, 5),
                ])->values()->toArray(),
            ];
        }

        return $schedule;
    }

    public function deleteSchedule(PractitionerOfferingSlot $slot): void
    {
        PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slot->id)->delete();
    }

    /**
     * Get available booking slots for a given date range.
     *
     * For each date:
     *  1. Get the offering slot's own schedule (day-of-week pattern)
     *  2. Filter those times against the healer's live availability schedule
     *  3. Filter out already-booked times
     *
     * If the healer has no live schedule, the date shows as unavailable.
     */
    public function getAvailableSlots(PractitionerOfferingSlot $slot, string $startDate, string $endDate): array
    {
        // Load the offering's own weekly schedule
        $weeklySchedule = PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slot->id)
            ->orderBy('day_of_week')->orderBy('start_time')
            ->get()->groupBy('day_of_week');

        // Load existing bookings in the date range
        $bookings = PractitionerOfferingBooking::where('practitioner_offering_slot_id', $slot->id)
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        // Get the healer's profile ID via the offering
        $profileId = $slot->offering->practitioner_profile_id;

        $result = [];

        for ($date = Carbon::parse($startDate); $date->lte(Carbon::parse($endDate)); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $dayOfWeek  = $date->dayOfWeek;

            // ── Step 1: Check offering slot schedule ──────────────────────────
            if (! isset($weeklySchedule[$dayOfWeek])) {
                $result[] = ['date' => $dateString, 'available_times' => [], 'reason' => 'not_in_offering_schedule'];
                continue;
            }

            // ── Step 2: Check healer live availability ────────────────────────
            $healerSlots = $this->healerAvailabilityService->getAvailableTimesForDate($profileId, $dateString);

            if ($healerSlots === null) {
                // No healer schedule covering this date at all
                $result[] = ['date' => $dateString, 'available_times' => [], 'reason' => 'healer_no_schedule'];
                continue;
            }

            if (empty($healerSlots)) {
                // Healer schedule exists but day is unavailable (skipped or not in pattern)
                $result[] = ['date' => $dateString, 'available_times' => [], 'reason' => 'healer_unavailable'];
                continue;
            }

            // ── Step 3: Intersect offering schedule with healer availability ──
            $dateBookings   = $bookings->filter(
                fn ($b) => Carbon::parse($b->booking_date)->format('Y-m-d') === $dateString
            );
            $availableTimes = [];

            foreach ($weeklySchedule[$dayOfWeek] as $block) {
                $current  = Carbon::parse($block->start_time);
                $blockEnd = Carbon::parse($block->end_time);

                while ($current->copy()->addMinutes($slot->duration)->lte($blockEnd)) {
                    $slotStart = $current->format('H:i:s');
                    $slotEnd   = $current->copy()->addMinutes($slot->duration)->format('H:i:s');

                    // Check against healer availability
                    $healerCoversThisSlot = collect($healerSlots)->contains(function ($ts) use ($slotStart, $slotEnd) {
                        $healerStart = Carbon::parse($ts['start_time']);
                        $healerEnd   = Carbon::parse($ts['end_time']);
                        return Carbon::parse($slotStart)->gte($healerStart)
                            && Carbon::parse($slotEnd)->lte($healerEnd);
                    });

                    if (! $healerCoversThisSlot) {
                        $current->addMinutes(30);
                        continue;
                    }

                    // Check against existing bookings
                    $isBooked = $dateBookings->contains(
                        fn ($b) => $slotStart < $b->end_time && $slotEnd > $b->start_time
                    );

                    if (! $isBooked) {
                        $availableTimes[] = substr($slotStart, 0, 5);
                    }

                    $current->addMinutes(30);
                }
            }

            $result[] = ['date' => $dateString, 'available_times' => $availableTimes];
        }

        return $result;
    }
}
<?php

namespace App\Services;

use App\Models\ServiceAvailability;
use App\Models\ServiceBooking;
use App\Models\ServiceSlot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AvailabilityService
{
    /**
     * Store availability schedule for a service slot
     */
    public function storeSchedule(ServiceSlot $slot, array $scheduleData): array
    {
        DB::beginTransaction();
        try {
            // Delete existing availability for this slot
            ServiceAvailability::where('service_slot_id', $slot->id)->delete();

            // Insert new schedule
            foreach ($scheduleData as $day) {
                if ($day['is_available'] && ! empty($day['time_slots'])) {
                    foreach ($day['time_slots'] as $timeSlot) {
                        ServiceAvailability::create([
                            'service_slot_id' => $slot->id,
                            'day_of_week' => $day['day_of_week'],
                            'start_time' => $timeSlot['start_time'],
                            'end_time' => $timeSlot['end_time'],
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

    /**
     * Get availability schedule for a service slot
     */
    public function getSchedule(ServiceSlot $slot): array
    {
        $availability = ServiceAvailability::where('service_slot_id', $slot->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        // Group by day of week
        $schedule = [];
        for ($day = 0; $day <= 6; $day++) {
            $daySlots = $availability->where('day_of_week', $day);

            $schedule[] = [
                'day_of_week' => $day,
                'is_available' => $daySlots->isNotEmpty(),
                'time_slots' => $daySlots->map(function ($slot) {
                    return [
                        'start_time' => substr($slot->start_time, 0, 5), // HH:MM format
                        'end_time' => substr($slot->end_time, 0, 5),
                    ];
                })->values()->toArray(),
            ];
        }

        return $schedule;
    }

    /**
     * Delete availability schedule for a slot
     */
    public function deleteSchedule(ServiceSlot $slot): void
    {
        ServiceAvailability::where('service_slot_id', $slot->id)->delete();
    }

    /**
     * Get available booking times for a date range
     * This generates actual available times based on the weekly schedule
     */
    public function getAvailableSlots(ServiceSlot $slot, string $startDate, string $endDate): array
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Get the weekly schedule
        $weeklySchedule = ServiceAvailability::where('service_slot_id', $slot->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        // Get existing bookings in the date range
        $bookings = ServiceBooking::where('service_slot_id', $slot->id)
            ->where('booking_date', '>=', $startDate)
            ->where('booking_date', '<=', $endDate)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        $availabilityByDate = [];

        // Generate availability for each date
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dayOfWeek = $date->dayOfWeek;
            $dateString = $date->format('Y-m-d');

            // Check if this day has availability in the schedule
            if (! isset($weeklySchedule[$dayOfWeek])) {
                $availabilityByDate[] = [
                    'date' => $dateString,
                    'available_times' => [],
                ];

                continue;
            }

            $availableTimes = [];

            // Get bookings for this specific date
            $dateBookings = $bookings->filter(function ($booking) use ($dateString) {
                $bookingDate = Carbon::parse($booking->booking_date)->format('Y-m-d');

                return $bookingDate === $dateString;
            });

            // For each time block in the schedule for this day
            foreach ($weeklySchedule[$dayOfWeek] as $scheduleBlock) {
                $blockStart = Carbon::parse($scheduleBlock->start_time);
                $blockEnd = Carbon::parse($scheduleBlock->end_time);

                // Generate time slots based on service duration
                $currentTime = $blockStart->copy();
                while ($currentTime->copy()->addMinutes($slot->duration)->lte($blockEnd)) {
                    $slotStartTime = $currentTime->format('H:i:s');
                    $slotEndTime = $currentTime->copy()->addMinutes($slot->duration)->format('H:i:s');

                    // Check if this time slot is already booked
                    $isBooked = false;

                    foreach ($dateBookings as $booking) {
                        $bookingStart = $booking->start_time;
                        $bookingEnd = $booking->end_time;

                        // Check for overlap: slot overlaps if it starts before booking ends AND ends after booking starts
                        if ($slotStartTime < $bookingEnd && $slotEndTime > $bookingStart) {
                            $isBooked = true;
                            break;
                        }
                    }

                    // Only add to available times if NOT booked
                    if (! $isBooked) {
                        $availableTimes[] = substr($slotStartTime, 0, 5);
                    }

                    $currentTime->addMinutes(30);
                }
            }

            $availabilityByDate[] = [
                'date' => $dateString,
                'available_times' => $availableTimes,
            ];
        }

        return $availabilityByDate;
    }
}

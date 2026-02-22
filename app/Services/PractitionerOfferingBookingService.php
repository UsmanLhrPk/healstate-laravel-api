<?php

namespace App\Services;

use App\Models\PractitionerOfferingAvailability;
use App\Models\PractitionerOfferingBooking;
use App\Models\PractitionerOfferingSlot;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PractitionerOfferingBookingService
{
    public function createBooking(int $userId, array $data): PractitionerOfferingBooking
    {
        return DB::transaction(function () use ($userId, $data) {
            $slot = PractitionerOfferingSlot::findOrFail($data['practitioner_offering_slot_id']);

            if ($this->checkTimeOverlap($slot->id, $data['booking_date'], $data['start_time'], $data['end_time'])) {
                throw new \Exception('Time slot is already booked');
            }

            if (! $this->checkAvailabilitySchedule($slot->id, $data['booking_date'], $data['start_time'], $data['end_time'])) {
                throw new \Exception('Practitioner is not available at this time');
            }

            $data['user_id'] = $userId;
            return PractitionerOfferingBooking::create($data);
        });
    }

    public function cancelBooking(PractitionerOfferingBooking $booking): PractitionerOfferingBooking
    {
        DB::transaction(fn () => $booking->update(['status' => 'cancelled']));
        return $booking->fresh();
    }

    public function getUserBookings(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return PractitionerOfferingBooking::where('user_id', $userId)
            ->with(['slot.offering.practitionerProfile', 'slot.offering.subcategory'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate($perPage);
    }

    public function getPractitionerBookings(int $profileId, int $perPage = 15): LengthAwarePaginator
    {
        return PractitionerOfferingBooking::whereHas('slot.offering', function ($q) use ($profileId) {
                $q->where('practitioner_profile_id', $profileId);
            })
            ->with(['slot.offering.subcategory', 'user'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate($perPage);
    }

    protected function checkTimeOverlap(int $slotId, string $date, string $start, string $end): bool
    {
        return PractitionerOfferingBooking::where('practitioner_offering_slot_id', $slotId)
            ->where('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_time', [$start, $end])
                  ->orWhereBetween('end_time', [$start, $end])
                  ->orWhere(fn ($q2) => $q2->where('start_time', '<=', $start)->where('end_time', '>=', $end));
            })
            ->exists();
    }

    protected function checkAvailabilitySchedule(int $slotId, string $date, string $start, string $end): bool
    {
        $dayOfWeek = Carbon::parse($date)->dayOfWeek;

        $availabilities = PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slotId)
            ->where('day_of_week', $dayOfWeek)
            ->get();

        if ($availabilities->isEmpty()) return false;

        foreach ($availabilities as $a) {
            if ($start >= $a->start_time && $end <= $a->end_time) return true;
        }

        return false;
    }
}

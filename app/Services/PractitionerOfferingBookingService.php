<?php

namespace App\Services;

use App\Models\PractitionerOfferingBooking;
use App\Models\PractitionerOfferingSlot;
use App\Notifications\PractitionerBookingCancellationRequestNotification;
use App\Notifications\PractitionerBookingCancelledNotification;
use App\Notifications\PractitionerBookingConfirmationNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PractitionerOfferingBookingService
{
    public function __construct(
        protected PractitionerAvailabilityService $availabilityService
    ) {}

    public function createBooking(int $userId, array $data): PractitionerOfferingBooking
    {
        return DB::transaction(function () use ($userId, $data) {
            $slot = PractitionerOfferingSlot::with('offering.practitionerProfile')
                ->findOrFail($data['practitioner_offering_slot_id']);

            // ── 1. Check for existing booking overlap ─────────────────────────
            if ($this->checkTimeOverlap($slot->id, $data['booking_date'], $data['start_time'], $data['end_time'])) {
                throw new \Exception('This time slot has already been booked. Please choose a different time.');
            }

            // ── 2. Check offering slot schedule (offering-level availability) ──
            if (! $this->checkOfferingSlotSchedule($slot->id, $data['booking_date'], $data['start_time'], $data['end_time'])) {
                throw new \Exception('This offering is not available at the requested time.');
            }

            // ── 3. Check healer availability schedule ─────────────────────────
            $profileId = $slot->offering->practitioner_profile_id;
            if (! $this->availabilityService->isAvailable(
                $profileId,
                $data['booking_date'],
                $data['start_time'],
                $data['end_time']
            )) {
                throw new \Exception('The healer is not available at the requested time.');
            }

            // ── 4. Create the booking ─────────────────────────────────────────
            try {
                $data['user_id'] = $userId;
                $booking = PractitionerOfferingBooking::create($data);
            } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                throw new \Exception('This time slot was just booked by someone else. Please choose a different time.');
            }

            // ── 5. Send confirmation ──────────────────────────────────────────
            try {
                $booking->user->notify(new PractitionerBookingConfirmationNotification($booking));
            } catch (\Exception $e) {
                Log::warning("Failed to send booking confirmation: " . $e->getMessage());
            }

            return $booking;
        });
    }

    public function cancelBooking(PractitionerOfferingBooking $booking): PractitionerOfferingBooking
    {
        $booking->update(['status' => 'cancelled']);
        return $booking->fresh();
    }

    public function requestCancellation(PractitionerOfferingBooking $booking, ?string $reason): PractitionerOfferingBooking
    {
        $booking->update([
            'status'                    => 'cancellation_requested',
            'cancellation_reason'       => $reason,
            'cancellation_requested_at' => now(),
        ]);

        try {
            $healer = $booking->slot->offering->practitionerProfile->user;
            $healer->notify(new PractitionerBookingCancellationRequestNotification($booking));
        } catch (\Exception $e) {
            Log::warning("Failed to send cancellation request notification: " . $e->getMessage());
        }

        return $booking->fresh();
    }

    public function approveCancellation(PractitionerOfferingBooking $booking): PractitionerOfferingBooking
    {
        $booking->update(['status' => 'cancelled']);

        try {
            $booking->user->notify(new PractitionerBookingCancelledNotification($booking, true));
        } catch (\Exception $e) {
            Log::warning("Failed to send cancellation approval notification: " . $e->getMessage());
        }

        return $booking->fresh();
    }

    public function denyCancellation(PractitionerOfferingBooking $booking, ?string $reason): PractitionerOfferingBooking
    {
        $booking->update([
            'status'                    => 'confirmed',
            'cancellation_reason'       => null,
            'cancellation_requested_at' => null,
        ]);

        try {
            $booking->user->notify(new PractitionerBookingCancelledNotification($booking, false, $reason));
        } catch (\Exception $e) {
            Log::warning("Failed to send cancellation denial notification: " . $e->getMessage());
        }

        return $booking->fresh();
    }

    public function getUserBookings(int $userId, int $perPage = 15, ?string $status = null): LengthAwarePaginator
    {
        $query = PractitionerOfferingBooking::where('user_id', $userId)
            ->with(['slot.offering.practitionerProfile.user', 'slot.offering'])
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    public function getPractitionerBookings(int $profileId, int $perPage = 15, ?string $status = null): LengthAwarePaginator
    {
        $query = PractitionerOfferingBooking::whereHas('slot.offering', function ($q) use ($profileId) {
            $q->where('practitioner_profile_id', $profileId);
        })
        ->with(['slot.offering', 'user'])
        ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    protected function checkTimeOverlap(int $slotId, string $date, string $startTime, string $endTime): bool
    {
        return PractitionerOfferingBooking::where('practitioner_offering_slot_id', $slotId)
            ->where('booking_date', $date)
            ->whereNotIn('status', ['cancelled'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
                });
            })
            ->exists();
    }

    /**
     * Check whether the offering slot's own schedule covers this date/time.
     * This is the offering-level check (separate from healer availability).
     */
    protected function checkOfferingSlotSchedule(int $slotId, string $date, string $startTime, string $endTime): bool
    {
        // If no offering slot schedule exists, treat as available
        // (offering schedule is optional — healer schedule is the primary gate)
        $hasSchedule = \App\Models\PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slotId)
            ->exists();

        if (! $hasSchedule) return true;

        // Use the existing availability service logic
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;

        return \App\Models\PractitionerOfferingAvailability::where('practitioner_offering_slot_id', $slotId)
            ->where('day_of_week', $dayOfWeek)
            ->where('start_time', '<=', $startTime)
            ->where('end_time', '>=', $endTime)
            ->exists();
    }
}
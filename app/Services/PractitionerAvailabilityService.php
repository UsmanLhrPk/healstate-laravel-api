<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PractitionerAvailabilitySchedule;
use App\Models\PractitionerOfferingBooking;
use App\Models\PractitionerProfile;
use App\Notifications\HealerDaySkippedBookingCancelledNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PractitionerAvailabilityService
{
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    // ─── Create initial 2-week blocks from application ───────────────────────

    public function createFromApplication(PractitionerProfile $profile, array $schedule): void
    {
        $weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY);

        for ($i = 0; $i < 2; $i++) {
            $start = $weekStart->copy()->addWeeks($i);
            $end   = $start->copy()->addDays(6);

            PractitionerAvailabilitySchedule::create([
                'practitioner_profile_id' => $profile->id,
                'week_start_date'         => $start->toDateString(),
                'week_end_date'           => $end->toDateString(),
                'weekly_pattern'          => $schedule['days'] ?? $schedule,
                'is_active'               => true,
                'skipped_dates'           => [],
                'source'                  => $i === 0 ? 'application' : 'repeat',
            ]);
        }
    }

    // ─── Repeat: append one new week block after the last ────────────────────

    public function repeat(PractitionerProfile $profile): PractitionerAvailabilitySchedule
    {
        $last = PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->active()
            ->orderByDesc('week_end_date')
            ->firstOrFail();

        $newStart = Carbon::parse($last->week_end_date)->addDay();
        $newEnd   = $newStart->copy()->addDays(6);

        return PractitionerAvailabilitySchedule::create([
            'practitioner_profile_id' => $profile->id,
            'week_start_date'         => $newStart->toDateString(),
            'week_end_date'           => $newEnd->toDateString(),
            'weekly_pattern'          => $last->weekly_pattern,
            'is_active'               => true,
            'skipped_dates'           => [],
            'source'                  => 'repeat',
        ]);
    }

    // ─── Pre-flight check: how many bookings would be affected ───────────────

    public function getAffectedBookingsCount(PractitionerProfile $profile, string $date): int
    {
        return PractitionerOfferingBooking::whereHas(
            'slot.offering',
            fn ($q) => $q->where('practitioner_profile_id', $profile->id)
        )
        ->where('booking_date', $date)
        ->whereNotIn('status', ['cancelled', 'completed'])
        ->count();
    }

    // ─── Skip a date ─────────────────────────────────────────────────────────

    /**
     * Skip a date with cancellation reason.
     *
     * Rules:
     * - Date must be at least 24 hours in the future.
     * - All active bookings on that date are cancelled.
     * - Each booking's parent order is refunded via PaymentService.
     * - Customer is emailed with booking details and healer's reason.
     *
     * Returns:
     *   ['schedule' => PractitionerAvailabilitySchedule, 'cancelled_bookings' => int]
     *
     * @throws \Exception if within 24 hours or no schedule covers the date.
     */
    public function skipDate(PractitionerProfile $profile, string $date, string $reason): array
    {
        // ── 1. Enforce 24-hour rule ───────────────────────────────────────────
        $targetDate = Carbon::parse($date)->startOfDay();
        $cutoff     = Carbon::now()->addHours(24);

        if ($targetDate->lessThan($cutoff)) {
            throw new \Exception(
                'You can only skip a date that is at least 24 hours away. ' .
                'This date is too close to cancel.'
            );
        }

        // ── 2. Find the block covering this date ──────────────────────────────
        $block = $this->getBlockForDate($profile->id, $date);

        if (! $block) {
            throw new \Exception('No active availability schedule covers this date.');
        }

        // ── 3. Skip the date + cancel bookings in a transaction ───────────────
        return DB::transaction(function () use ($block, $date, $reason, $profile) {

            // Mark date as skipped
            $block->skipDate($date);
            $block->save();

            // Find all active bookings on this date for this healer's offerings
            $bookings = PractitionerOfferingBooking::whereHas(
                'slot.offering',
                fn ($q) => $q->where('practitioner_profile_id', $profile->id)
            )
            ->where('booking_date', $date)
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->with(['user', 'slot.offering'])
            ->get();

            $cancelledCount = 0;

            foreach ($bookings as $booking) {
                // Cancel the booking
                $booking->update([
                    'status'                    => 'cancelled',
                    'cancellation_reason'       => 'Healer unavailable: ' . $reason,
                    'cancellation_requested_at' => now(),
                ]);

                $cancelledCount++;

                // Process refund via the order that contains this booking
                $this->processBookingRefund($booking);

                // Notify the customer by email
                try {
                    $booking->user->notify(
                        new HealerDaySkippedBookingCancelledNotification(
                            booking:    $booking,
                            reason:     $reason,
                            healerName: $profile->user->name ?? 'Your healer',
                        )
                    );
                } catch (\Exception $e) {
                    Log::warning(
                        "Failed to send skip-day cancellation email for booking #{$booking->id}: "
                        . $e->getMessage()
                    );
                }
            }

            return [
                'schedule'           => $block->fresh(),
                'cancelled_bookings' => $cancelledCount,
            ];
        });
    }

    // ─── Unskip a date ───────────────────────────────────────────────────────

    public function unskipDate(PractitionerProfile $profile, string $date): PractitionerAvailabilitySchedule
    {
        $block = $this->getBlockForDate($profile->id, $date);

        if (! $block) {
            throw new \Exception('No active availability schedule covers this date.');
        }

        $block->unskipDate($date);
        $block->save();

        return $block->fresh();
    }

    // ─── isAvailable (used by booking service) ───────────────────────────────

    public function isAvailable(int $profileId, string $date, string $startTime, string $endTime): bool
    {
        $block = $this->getBlockForDate($profileId, $date);

        if (! $block) return false;
        if ($block->isDateSkipped($date)) return false;

        $dayName     = strtolower(Carbon::parse($date)->format('l'));
        $daySchedule = $block->getDaySchedule($dayName);

        if (! $daySchedule || ! ($daySchedule['is_available'] ?? false)) return false;

        foreach ($daySchedule['time_slots'] ?? [] as $slot) {
            if ($slot['start_time'] <= $startTime && $slot['end_time'] >= $endTime) {
                return true;
            }
        }

        return false;
    }

    // ─── Get available times for a date ──────────────────────────────────────

    public function getAvailableTimesForDate(int $profileId, string $date): ?array
    {
        $block = $this->getBlockForDate($profileId, $date);

        if (! $block || $block->isDateSkipped($date)) return null;

        $dayName = strtolower(Carbon::parse($date)->format('l'));
        return $block->getDaySchedule($dayName);
    }

    // ─── Listing helpers ─────────────────────────────────────────────────────

    public function getSchedule(PractitionerProfile $profile): \Illuminate\Database\Eloquent\Collection
    {
        return PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->active()
            ->orderBy('week_start_date')
            ->get();
    }

    public function getUpcomingSchedule(PractitionerProfile $profile): \Illuminate\Database\Eloquent\Collection
    {
        return PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->active()
            ->where('week_end_date', '>=', now()->toDateString())
            ->orderBy('week_start_date')
            ->get();
    }

    // ─── Private helpers ─────────────────────────────────────────────────────


    // ─── Update weekly pattern across ALL future blocks ───────────────────────

    /**
     * Update the weekly_pattern for all active blocks from today forward.
     *
     * Rules:
     * - Only future blocks (week_end_date >= today) are updated.
     * - Past blocks are left unchanged.
     * - For any day that is being removed (was available, now not), every future
     *   booking on that day is cancelled + refunded + customer emailed.
     * - The reason is included in the cancellation notification.
     *
     * Returns:
     *   ['updated_blocks' => int, 'cancelled_bookings' => int]
     */
    public function updatePattern(PractitionerProfile $profile, array $newPattern, string $reason): array
    {
        $today = Carbon::today()->toDateString();

        $futureBlocks = PractitionerAvailabilitySchedule::forProfile($profile->id)
            ->active()
            ->where('week_end_date', '>=', $today)
            ->get();

        if ($futureBlocks->isEmpty()) {
            throw new \Exception('No upcoming schedule blocks to update.');
        }

        return DB::transaction(function () use ($futureBlocks, $newPattern, $reason, $profile, $today) {

            $cancelledTotal = 0;

            foreach ($futureBlocks as $block) {
                $oldPattern = $block->weekly_pattern ?? [];

                // Find days that are being disabled or having hours reduced
                $removedDates = $this->getDatesAffectedByPatternChange(
                    $block, $oldPattern, $newPattern, $today
                );

                // Cancel bookings on removed/narrowed dates
                foreach ($removedDates as $date) {
                    $bookings = PractitionerOfferingBooking::whereHas(
                        'slot.offering',
                        fn ($q) => $q->where('practitioner_profile_id', $profile->id)
                    )
                    ->where('booking_date', $date)
                    ->whereNotIn('status', ['cancelled', 'completed'])
                    ->with(['user', 'slot.offering'])
                    ->get();

                    foreach ($bookings as $booking) {
                        $booking->update([
                            'status'                    => 'cancelled',
                            'cancellation_reason'       => 'Healer updated their schedule: ' . $reason,
                            'cancellation_requested_at' => now(),
                        ]);
                        $cancelledTotal++;
                        $this->processBookingRefund($booking);

                        try {
                            $booking->user->notify(
                                new \App\Notifications\HealerDaySkippedBookingCancelledNotification(
                                    booking:    $booking,
                                    reason:     'Schedule updated: ' . $reason,
                                    healerName: $profile->user->name ?? 'Your healer',
                                )
                            );
                        } catch (\Exception $e) {
                            Log::warning("Failed to send schedule-update cancellation email for booking #{$booking->id}: " . $e->getMessage());
                        }
                    }
                }

                // Update the block pattern
                $block->update(['weekly_pattern' => $newPattern]);
            }

            return [
                'updated_blocks'    => $futureBlocks->count(),
                'cancelled_bookings' => $cancelledTotal,
            ];
        });
    }

    /**
     * Get all future dates within a block that are affected by a pattern change.
     * A date is affected if:
     *  - Its day is being disabled entirely, OR
     *  - Its day's time range is being narrowed (bookings outside new range become invalid)
     */
    private function getDatesAffectedByPatternChange(
        PractitionerAvailabilitySchedule $block,
        array $oldPattern,
        array $newPattern,
        string $today
    ): array {
        $affected = [];
        $cursor   = Carbon::parse(max($block->week_start_date->toDateString(), $today));
        $end      = Carbon::parse($block->week_end_date->toDateString());

        while ($cursor->lte($end)) {
            $dateStr = $cursor->toDateString();
            $dayName = strtolower($cursor->format('l'));

            $wasAvailable = ($oldPattern[$dayName]['is_available'] ?? false);
            $nowAvailable = ($newPattern[$dayName]['is_available'] ?? false);

            if ($wasAvailable) {
                if (! $nowAvailable) {
                    // Day fully removed
                    $affected[] = $dateStr;
                } else {
                    // Check if hours narrowed — only flag if there are bookings outside new range
                    $oldStart = $oldPattern[$dayName]['time_slots'][0]['start_time'] ?? '00:00';
                    $oldEnd   = $oldPattern[$dayName]['time_slots'][0]['end_time']   ?? '23:59';
                    $newStart = $newPattern[$dayName]['time_slots'][0]['start_time'] ?? '00:00';
                    $newEnd   = $newPattern[$dayName]['time_slots'][0]['end_time']   ?? '23:59';

                    if ($newStart > $oldStart || $newEnd < $oldEnd) {
                        // Hours narrowed — we'll check actual bookings when we get there
                        $affected[] = $dateStr;
                    }
                }
            }

            $cursor->addDay();
        }

        return $affected;
    }

    private function getBlockForDate(int $profileId, string $date): ?PractitionerAvailabilitySchedule
    {
        return PractitionerAvailabilitySchedule::forProfile($profileId)
            ->active()
            ->coveringDate($date)
            ->first();
    }

    /**
     * Find the order that contains this booking, then refund it.
     *
     * The payment_intent_id lives on the Order (not the booking directly).
     * We trace: booking → order_item (practitioner_offering_booking_id) → order.
     *
     * We refund the order item's subtotal (the slot price × qty) rather than
     * the full order total, in case the order also contained other items.
     */
    private function processBookingRefund(PractitionerOfferingBooking $booking): void
    {
        // Find the order item that references this booking
        $orderItem = \App\Models\OrderItem::where('practitioner_offering_booking_id', $booking->id)
            ->with('order')
            ->first();

        if (! $orderItem || ! $orderItem->order) {
            Log::warning("No order item found for booking #{$booking->id} — skipping refund.");
            return;
        }

        $order = $orderItem->order;

        if (! $order->payment_intent_id) {
            Log::warning("Order #{$order->id} has no payment_intent_id — skipping refund for booking #{$booking->id}.");
            return;
        }

        // Only refund statuses that actually had money taken
        if (! in_array($order->status, ['paid', 'processing', 'shipped', 'delivered', 'cancellation_requested'])) {
            Log::info("Order #{$order->id} status is '{$order->status}' — no refund needed for booking #{$booking->id}.");
            return;
        }

        try {
            $refundAmount   = (float) $orderItem->subtotal;
            $refundCurrency = $order->currency ?? 'USD';

            $refund = $this->paymentService->refundPayment(
                $order->payment_intent_id,
                $refundAmount,
                $refundCurrency,
            );

            // Record refund details on the order item level
            $orderItem->update([
                'refund_id'     => $refund['refund_id'],
                'refund_status' => $refund['status'],
                'refunded_at'   => now(),
                'refund_amount' => $refund['amount'],
            ]);

            Log::info("Refund processed for booking #{$booking->id} (order #{$order->id})", [
                'refund_id' => $refund['refund_id'],
                'amount'    => $refund['amount'],
                'currency'  => $refund['currency'],
            ]);

        } catch (\Exception $e) {
            // Log but don't abort — booking is already cancelled.
            // A failed refund should be flagged for manual resolution, not rolled back.
            Log::error(
                "Refund failed for booking #{$booking->id} (order #{$order->id}): " . $e->getMessage(),
                ['payment_intent_id' => $order->payment_intent_id]
            );
        }
    }
}
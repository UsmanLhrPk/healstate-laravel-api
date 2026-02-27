<?php

namespace App\Console\Commands;

use App\Models\PractitionerOfferingBooking;
use App\Notifications\PractitionerBookingReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendBookingReminders extends Command
{
    protected $signature   = 'bookings:send-reminders';
    protected $description = 'Send email reminders to users with upcoming practitioner bookings';

    public function handle(): void
    {
        // 24-hour reminder
        $this->sendReminders(24, '24 hours');

        // 1-hour reminder
        $this->sendReminders(1, '1 hour');

        $this->info('Booking reminders sent.');
    }

    private function sendReminders(int $hoursAhead, string $label): void
    {
        $windowStart = now()->addHours($hoursAhead)->subMinutes(10);
        $windowEnd   = now()->addHours($hoursAhead)->addMinutes(10);

        $bookings = PractitionerOfferingBooking::whereIn('status', ['confirmed', 'pending'])
            ->whereRaw("CONCAT(booking_date, ' ', start_time) BETWEEN ? AND ?", [
                $windowStart->format('Y-m-d H:i:s'),
                $windowEnd->format('Y-m-d H:i:s'),
            ])
            ->with(['user', 'slot.offering'])
            ->get();

        foreach ($bookings as $booking) {
            try {
                $booking->user->notify(
                    new PractitionerBookingReminderNotification($booking, $label)
                );
                $this->line("  Sent {$label} reminder → {$booking->user->email}");
            } catch (\Exception $e) {
                Log::error("Failed to send {$label} reminder for booking {$booking->id}: " . $e->getMessage());
            }
        }

        $this->info("  [{$label}] Processed {$bookings->count()} reminders.");
    }
}
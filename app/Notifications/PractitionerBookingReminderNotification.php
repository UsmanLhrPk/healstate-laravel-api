<?php

namespace App\Notifications;

use App\Models\PractitionerOfferingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PractitionerBookingReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public PractitionerOfferingBooking $booking,
        public string $timeLabel // e.g. "24 hours" or "1 hour"
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $offering = $this->booking->slot?->offering;
        $date     = \Carbon\Carbon::parse($this->booking->booking_date)->format('l, F j, Y');
        $start    = \Carbon\Carbon::parse($this->booking->start_time)->format('g:i A');
        $end      = \Carbon\Carbon::parse($this->booking->end_time)->format('g:i A');

        return (new MailMessage)
            ->subject("Reminder: Your session is in {$this->timeLabel}")
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line("This is a reminder that your session is coming up in **{$this->timeLabel}**.")
            ->line('**Service:** ' . ($offering?->title ?? 'Session'))
            ->line('**Date:** ' . $date)
            ->line('**Time:** ' . $start . ' – ' . $end)
            ->action('View My Bookings', url('/bookings'))
            ->line('See you soon!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'        => 'booking_reminder',
            'booking_id'  => $this->booking->id,
            'offering'    => $this->booking->slot?->offering?->title,
            'booking_date'=> $this->booking->booking_date,
            'start_time'  => $this->booking->start_time,
            'message'     => "Your session is in {$this->timeLabel}.",
        ];
    }
}
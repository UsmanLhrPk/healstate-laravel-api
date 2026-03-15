<?php

namespace App\Notifications;

use App\Models\PractitionerOfferingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PractitionerBookingCancelledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public PractitionerOfferingBooking $booking,
        public bool $approved,
        public ?string $reason = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $offering = $this->booking->slot?->offering;
        $date     = \Carbon\Carbon::parse($this->booking->booking_date)->format('M j, Y');
        $start    = \Carbon\Carbon::parse($this->booking->start_time)->format('g:i A');

        if ($this->approved) {
            return (new MailMessage)
                ->subject('Booking Cancellation Approved')
                ->greeting('Hello ' . $notifiable->name . '!')
                ->line('Your cancellation request has been approved.')
                ->line('**Service:** ' . ($offering?->title ?? 'Session'))
                ->line('**Date:** ' . $date . ' at ' . $start)
                ->action('Browse Services', url('/services'))
                ->line('We hope to see you again soon.');
        }

        return (new MailMessage)
            ->subject('Cancellation Request Denied')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your cancellation request has been denied.')
            ->line('**Service:** ' . ($offering?->title ?? 'Session'))
            ->line('**Date:** ' . $date . ' at ' . $start)
            ->when($this->reason, fn($m) => $m->line('**Reason:** ' . $this->reason))
            ->action('View My Bookings', url('/bookings'))
            ->line('If you have questions, please contact the healer directly.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'       => $this->approved ? 'booking_cancellation_approved' : 'booking_cancellation_denied',
            'booking_id' => $this->booking->id,
            'offering'   => $this->booking->slot?->offering?->title,
            'message'    => $this->approved
                ? 'Your cancellation request was approved.'
                : 'Your cancellation request was denied.' . ($this->reason ? ' Reason: ' . $this->reason : ''),
        ];
    }
}
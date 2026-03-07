<?php

namespace App\Notifications;

use App\Models\PractitionerOfferingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Sent to the customer when a healer skips a day,
 * cancelling one or more of their confirmed bookings.
 */
class HealerDaySkippedBookingCancelledNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected PractitionerOfferingBooking $booking,
        protected string $reason,
        protected string $healerName,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $date        = \Carbon\Carbon::parse($this->booking->booking_date)->format('l, F j, Y');
        $startTime   = \Carbon\Carbon::parse($this->booking->start_time)->format('g:i A');
        $endTime     = \Carbon\Carbon::parse($this->booking->end_time)->format('g:i A');
        $offering    = $this->booking->slot->offering->title ?? 'your session';

        return (new MailMessage)
            ->subject('Your booking has been cancelled – ' . $date)
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line('We\'re sorry to let you know that **' . $this->healerName . '** has cancelled your upcoming session.')
            ->line('**Booking details:**')
            ->line('• Service: ' . $offering)
            ->line('• Date: ' . $date)
            ->line('• Time: ' . $startTime . ' – ' . $endTime)
            ->line('**Reason from ' . $this->healerName . ':**')
            ->line($this->reason)
            ->line('You will receive a **full refund** within 5–10 business days, depending on your payment provider.')
            ->action('Browse other healers', url('/practitioners'))
            ->line('We apologise for the inconvenience and hope to match you with the right healer soon.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'       => 'healer_day_skipped_cancellation',
            'booking_id' => $this->booking->id,
            'healer'     => $this->healerName,
            'reason'     => $this->reason,
            'date'       => $this->booking->booking_date,
            'start_time' => $this->booking->start_time,
            'end_time'   => $this->booking->end_time,
            'offering'   => $this->booking->slot->offering->title ?? null,
            'refund'     => true,
        ];
    }
}
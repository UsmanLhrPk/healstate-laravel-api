<?php

namespace App\Notifications;

use App\Models\PractitionerOfferingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PractitionerBookingCancellationRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public PractitionerOfferingBooking $booking) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $offering  = $this->booking->slot?->offering;
        $healerId  = $offering?->profile?->id;
        $date      = \Carbon\Carbon::parse($this->booking->booking_date)->format('M j, Y');
        $start     = \Carbon\Carbon::parse($this->booking->start_time)->format('g:i A');

        return (new MailMessage)
            ->subject('Cancellation Request - ' . ($offering?->title ?? 'Session'))
            ->greeting('Hello!')
            ->line('A client has requested to cancel their booking.')
            ->line('**Service:** ' . ($offering?->title ?? 'Session'))
            ->line('**Client:** ' . $this->booking->user?->name)
            ->line('**Date:** ' . $date . ' at ' . $start)
            ->line('**Reason:** ' . ($this->booking->cancellation_reason ?? 'No reason provided'))
            ->action('Review Request', url("/healers/{$healerId}/bookings"))
            ->line('Please approve or deny this request from your dashboard.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'               => 'booking_cancellation_request',
            'booking_id'         => $this->booking->id,
            'client_name'        => $this->booking->user?->name,
            'offering'           => $this->booking->slot?->offering?->title,
            'booking_date'       => $this->booking->booking_date,
            'cancellation_reason'=> $this->booking->cancellation_reason,
            'message'            => ($this->booking->user?->name ?? 'A client') . ' requested to cancel their booking.',
        ];
    }
}
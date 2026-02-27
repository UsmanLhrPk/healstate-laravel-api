<?php

namespace App\Notifications;

use App\Models\PractitionerOfferingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PractitionerBookingConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public PractitionerOfferingBooking $booking) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $offering = $this->booking->slot?->offering;
        $date     = $this->booking->booking_date instanceof \Carbon\Carbon
            ? $this->booking->booking_date->format('l, F j, Y')
            : \Carbon\Carbon::parse($this->booking->booking_date)->format('l, F j, Y');
        $start    = \Carbon\Carbon::parse($this->booking->start_time)->format('g:i A');
        $end      = \Carbon\Carbon::parse($this->booking->end_time)->format('g:i A');

        return (new MailMessage)
            ->subject('Booking Confirmed - ' . ($offering?->title ?? 'Session'))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your session booking has been confirmed.')
            ->line('**Service:** ' . ($offering?->title ?? 'Session'))
            ->line('**Date:** ' . $date)
            ->line('**Time:** ' . $start . ' – ' . $end)
            ->line('**Duration:** ' . ($offering?->duration ?? '—') . ' minutes')
            ->action('View My Bookings', url('/bookings'))
            ->line('We look forward to seeing you!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'        => 'practitioner_booking_confirmation',
            'booking_id'  => $this->booking->id,
            'offering'    => $this->booking->slot?->offering?->title,
            'booking_date'=> $this->booking->booking_date,
            'start_time'  => $this->booking->start_time,
            'message'     => 'Your booking has been confirmed.',
        ];
    }
}
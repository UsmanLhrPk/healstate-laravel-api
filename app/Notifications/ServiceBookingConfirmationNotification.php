<?php

namespace App\Notifications;

use App\Models\ServiceBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceBookingConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public ServiceBooking $booking
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $serviceSlot = $this->booking->serviceSlot;
        $product = $serviceSlot?->product;
        
        $bookingDate = $this->booking->booking_date->format('l, F j, Y');
        $startTime = \Carbon\Carbon::parse($this->booking->start_time)->format('g:i A');
        $endTime = \Carbon\Carbon::parse($this->booking->end_time)->format('g:i A');
        
        return (new MailMessage)
            ->subject('Service Booking Confirmation')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your service booking has been confirmed.')
            ->line('**Service Details:**')
            ->line('Service: ' . ($product?->title ?? 'Service'))
            ->line('Date: ' . $bookingDate)
            ->line('Time: ' . $startTime . ' - ' . $endTime)
            ->line('Duration: ' . $serviceSlot?->duration . ' minutes')
            ->line('Total: $' . number_format($this->booking->total_price, 2))
            ->when($this->booking->notes, function ($mail) {
                return $mail->line('Notes: ' . $this->booking->notes);
            })
            ->action('View Booking', url('/dashboard/bookings/' . $this->booking->id))
            ->line('Thank you for your booking!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $serviceSlot = $this->booking->serviceSlot;
        $product = $serviceSlot?->product;
        
        return [
            'type' => 'service_booking_confirmation',
            'booking_id' => $this->booking->id,
            'service_name' => $product?->title ?? 'Service',
            'booking_date' => $this->booking->booking_date->toDateString(),
            'start_time' => $this->booking->start_time,
            'end_time' => $this->booking->end_time,
            'total_price' => $this->booking->total_price,
            'status' => $this->booking->status,
            'message' => 'Your service booking has been confirmed for ' . $this->booking->booking_date->format('M j, Y'),
        ];
    }
}
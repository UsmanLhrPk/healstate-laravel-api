<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirmationNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $orderUrl = url('/orders/' . $this->order->id);
        $cancellationDeadline = $this->order->created_at->copy()->addMinutes(30);

        return (new MailMessage)
            ->subject('Order Confirmation - ' . $this->order->order_number)
            ->greeting('Thank you for your order!')
            ->line('Your order has been confirmed.')
            ->line('**Order Number:** ' . $this->order->order_number)
            ->line('**Total Amount:** $' . number_format($this->order->total, 2))
            ->line('**Status:** ' . ucfirst($this->order->status))
            ->line('---')
            ->line('**Free Cancellation Window**')
            ->line('You can cancel this order immediately until **' . $cancellationDeadline->format('M d, Y h:i A') . '** (30 minutes from now).')
            ->line('After this time, you can still request cancellation, but it will require vendor approval.')
            ->line('---')
            ->action('View Order', $orderUrl)
            ->line('We will send you a shipping confirmation when your items are on the way.');
    }
}
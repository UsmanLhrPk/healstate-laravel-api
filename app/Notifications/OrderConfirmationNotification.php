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
        return (new MailMessage)
            ->subject('Order Confirmation - ' . $this->order->order_number)
            ->greeting('Thank you for your order!')
            ->line('Your order has been confirmed.')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Total Amount: $' . number_format($this->order->total, 2))
            ->line('Status: ' . ucfirst($this->order->status))
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('We will send you a shipping confirmation when your items are on the way.');
    }
}
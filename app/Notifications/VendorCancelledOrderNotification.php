<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorCancelledOrderNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order,
        public string $reason
    ) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Cancelled by Vendor - Order #' . $this->order->order_number)
            ->line('Your order #' . $this->order->order_number . ' has been cancelled by the vendor.')
            ->line('Reason: ' . $this->reason)
            ->line('You will receive a full refund within 5-7 business days.')
            ->action('View Order', url('/orders/' . $this->order->id));
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'reason' => $this->reason,
            'message' => 'Your order has been cancelled by the vendor',
        ];
    }
}
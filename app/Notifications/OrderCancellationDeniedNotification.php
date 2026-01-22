<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancellationDeniedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order,
        public ?string $denialReason = null
    ) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $orderUrl = url('/orders/' . $this->order->id);

        $message = (new MailMessage)
            ->subject('Cancellation Request Denied - Order #' . $this->order->order_number)
            ->greeting('Cancellation Request Update')
            ->line('Unfortunately, your cancellation request has been denied by the vendor.')
            ->line('**Order Number:** ' . $this->order->order_number)
            ->line('**Total Amount:** $' . number_format($this->order->total, 2));

        if ($this->denialReason) {
            $message->line('**Vendor\'s Reason:** ' . $this->denialReason);
        }

        $message->line('Your order will continue to be processed as normal.')
            ->action('View Order Details', $orderUrl)
            ->line('If you have any questions, please contact customer support.');

        return $message;
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'type' => 'cancellation_denied',
            'denial_reason' => $this->denialReason,
            'message' => 'Your cancellation request for order #' . $this->order->order_number . ' was denied',
        ];
    }
}
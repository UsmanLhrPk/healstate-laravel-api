<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// Notification sent to vendors when a customer requests order cancellation
class OrderCancellationRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order
    ) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $orderUrl = url('/vendor/orders/'.$this->order->id);

        return (new MailMessage)
            ->subject('Cancellation Request - Order #'.$this->order->order_number)
            ->greeting('Hello!')
            ->line('A customer has requested to cancel an order.')
            ->line('**Order Number:** '.$this->order->order_number)
            ->line('**Total Amount:** $'.number_format($this->order->total, 2))
            ->line('**Reason:** '.($this->order->cancellation_reason ?? 'No reason provided'))
            ->line('**Requested At:** '.$this->order->cancellation_requested_at->format('M d, Y h:i A'))
            ->line('Please review and respond to this cancellation request.')
            ->action('Review Order', $orderUrl)
            ->line('You can approve or deny this request from your vendor dashboard.');
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'type' => 'cancellation_request',
            'message' => 'Customer requested to cancel order #'.$this->order->order_number,
            'cancellation_reason' => $this->order->cancellation_reason,
        ];
    }
}

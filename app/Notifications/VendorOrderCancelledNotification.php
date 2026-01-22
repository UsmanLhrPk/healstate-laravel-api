<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorOrderCancelledNotification extends Notification
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
        $orderUrl = url('/vendor/orders/' . $this->order->id);

        return (new MailMessage)
            ->subject('Order Cancelled - ' . $this->order->order_number)
            ->greeting('Order Cancellation Notice')
            ->line('A customer has cancelled their order within the 30-minute cancellation window.')
            ->line('**Order Number:** ' . $this->order->order_number)
            ->line('**Total Amount:** $' . number_format($this->order->total, 2))
            ->line('**Cancelled At:** ' . $this->order->cancellation_requested_at->format('M d, Y h:i A'));

        if ($this->order->cancellation_reason) {
            $message->line('**Reason:** ' . $this->order->cancellation_reason);
        }

        return $message->line('This order was cancelled immediately and does not require your approval.')
            ->action('View Order Details', $orderUrl)
            ->line('Please update your inventory accordingly.');
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'type' => 'vendor_order_cancelled',
            'message' => 'Order #' . $this->order->order_number . ' was cancelled by customer',
            'cancellation_reason' => $this->order->cancellation_reason,
        ];
    }
}
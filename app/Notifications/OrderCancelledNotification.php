<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelledNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order,
        public bool $approvedByVendor = false
    ) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $orderUrl = url('/orders/' . $this->order->id);

        $message = (new MailMessage)
            ->subject('Order Cancelled - ' . $this->order->order_number);

        if ($this->approvedByVendor) {
            $message->greeting('Your cancellation request has been approved')
                ->line('The vendor has approved your cancellation request.')
                ->line('Your order has been successfully cancelled.');
        } else {
            $message->greeting('Order Cancelled')
                ->line('Your order has been cancelled successfully.');
        }

        $message->line('**Order Number:** ' . $this->order->order_number)
            ->line('**Total Amount:** $' . number_format($this->order->total, 2))
            ->line('**Cancelled At:** ' . now()->format('M d, Y h:i A'));

        if ($this->order->cancellation_reason) {
            $message->line('**Reason:** ' . $this->order->cancellation_reason);
        }

        $message->line('A refund will be processed to your original payment method within 5-7 business days.')
            ->action('View Order Details', $orderUrl)
            ->line('Thank you for shopping with us!');

        return $message;
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'type' => 'order_cancelled',
            'approved_by_vendor' => $this->approvedByVendor,
            'message' => 'Your order #' . $this->order->order_number . ' has been cancelled',
        ];
    }
}   
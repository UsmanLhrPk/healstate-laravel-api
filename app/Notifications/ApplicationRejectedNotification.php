<?php

namespace App\Notifications;

use App\Models\EmailNotification;
use App\Models\PractitionerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public PractitionerApplication $application
    ) {}

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $subject = 'Application Status Update - HealState.org';

        // Log the email
        $this->logEmail($notifiable->email, $subject);

        $message = (new MailMessage)
            ->subject($subject)
            ->greeting('Hello ' . $notifiable->name)
            ->line('Thank you for your interest in becoming a practitioner on HealState.org.')
            ->line('After careful review, we regret to inform you that we are unable to approve your application at this time.');

        if ($this->application->rejection_reason) {
            $message->line('Reason: ' . $this->application->rejection_reason);
        }

        $message->line('You are welcome to reapply in the future once you have addressed any concerns.')
            ->line('If you have any questions about this decision, please contact our support team.')
            ->line('Thank you for your understanding.');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'message' => 'Your practitioner application status has been updated.',
            'status' => 'rejected',
            'rejection_reason' => $this->application->rejection_reason,
        ];
    }

    /**
     * Log the email notification.
     */
    protected function logEmail(string $email, string $subject): void
    {
        EmailNotification::create([
            'user_id' => $this->application->user_id,
            'email_to' => $email,
            'email_subject' => $subject,
            'email_type' => 'application_rejected',
            'related_application_id' => $this->application->id,
            'delivery_status' => 'sent',
        ]);
    }
}
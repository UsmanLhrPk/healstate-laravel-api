<?php

namespace App\Notifications;

use App\Models\EmailNotification;
use App\Models\PractitionerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationReceivedNotification extends Notification implements ShouldQueue
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
        $subject = 'Application Received - HealState.org';

        // Log the email
        $this->logEmail($notifiable->email, $subject);

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Thank you for submitting your practitioner application to HealState.org.')
            ->line('We have received your application and will review it within 3-5 business days.')
            ->line('You will receive an email notification once we have made a decision.')
            ->line('Application Details:')
            ->line('- Professional Title: ' . $this->application->professional_title)
            ->line('- Primary Category: ' . $this->application->primaryCategory->name)
            ->line('- Submitted: ' . $this->application->submitted_at->format('F j, Y'))
            ->action('View My Application', url('/dashboard/practitioner/application'))
            ->line('Thank you for your patience!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'message' => 'Your practitioner application has been received and is under review.',
            'status' => 'pending',
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
            'email_type' => 'application_received',
            'related_application_id' => $this->application->id,
            'delivery_status' => 'sent',
        ]);
    }
}
<?php

namespace App\Notifications;

use App\Models\EmailNotification;
use App\Models\PractitionerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationApprovedNotification extends Notification implements ShouldQueue
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
        $subject = 'Congratulations! Your Practitioner Application has been Approved';

        // Log the email
        $this->logEmail($notifiable->email, $subject);

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Congratulations ' . $notifiable->name . '!')
            ->line('We are pleased to inform you that your practitioner application has been approved.')
            ->line('Your practitioner profile is now active on HealState.org and visible to potential clients.')
            ->line('Next Steps:')
            ->line('1. Complete your profile with additional details and photos')
            ->line('2. Set up your availability schedule')
            ->line('3. Start accepting client bookings')
            ->action('View My Profile', url('/dashboard/practitioner/profile'))
            ->line('Welcome to the HealState.org practitioner community!')
            ->line('If you have any questions, please don\'t hesitate to contact our support team.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'message' => 'Your practitioner application has been approved! Your profile is now live.',
            'status' => 'approved',
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
            'email_type' => 'application_approved',
            'related_application_id' => $this->application->id,
            'delivery_status' => 'sent',
        ]);
    }
}
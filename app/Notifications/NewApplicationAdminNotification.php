<?php

namespace App\Notifications;

use App\Models\EmailNotification;
use App\Models\PractitionerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationAdminNotification extends Notification implements ShouldQueue
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
        $subject = 'New Practitioner Application - Review Required';

        // Log the email
        $this->logEmail($notifiable->email, $subject);

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hello Admin')
            ->line('A new practitioner application has been submitted and requires your review.')
            ->line('Applicant Information:')
            ->line('- Name: ' . $this->application->user->name)
            ->line('- Email: ' . $this->application->user->email)
            ->line('- Professional Title: ' . $this->application->professional_title)
            ->line('- Primary Category: ' . $this->application->primaryCategory->name)
            ->line('- Years of Experience: ' . $this->application->years_experience)
            ->line('- Submitted: ' . $this->application->submitted_at->format('F j, Y g:i A'))
            ->action('Review Application', url('/admin/practitioner-applications/' . $this->application->id))
            ->line('Please review and approve/reject this application within 3-5 business days.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'applicant_name' => $this->application->user->name,
            'applicant_email' => $this->application->user->email,
            'professional_title' => $this->application->professional_title,
            'message' => 'New practitioner application from ' . $this->application->user->name,
        ];
    }

    /**
     * Log the email notification.
     */
    protected function logEmail(string $email, string $subject): void
    {
        EmailNotification::create([
            'user_id' => null, // Admin notification
            'email_to' => $email,
            'email_subject' => $subject,
            'email_type' => 'new_application_admin',
            'related_application_id' => $this->application->id,
            'delivery_status' => 'sent',
        ]);
    }
}
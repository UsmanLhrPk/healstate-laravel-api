<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Concerns\LogsEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseSubmittedInstructorNotification extends Notification implements ShouldQueue
{
    use Queueable, LogsEmailNotification;

    public function __construct(
        protected Course $course
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->log('course_submitted', $notifiable->id, $this->course->id);

        return (new MailMessage)
            ->subject('Your Course Has Been Received')
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line('We have received your course submission and it is now under review.')
            ->line('**Course:** ' . $this->course->title)
            ->line('Our team will review your course within 3–5 business days and notify you of the outcome.')
            ->line('Thank you for contributing to the HealState community.');
    }
}
<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Concerns\LogsEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseRejectedNotification extends Notification implements ShouldQueue
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
        $this->log('course_rejected', $notifiable->id, $this->course->id);

        $editUrl = config('app.url') . '/dashboard/courses/' . $this->course->id . '/edit';

        $mail = (new MailMessage)
            ->subject('Update on Your Course Submission')
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line('After reviewing your submission, we were unable to approve your course at this time.')
            ->line('**Course:** ' . $this->course->title);

        if ($this->course->rejection_reason) {
            $mail->line('**Reason:** ' . $this->course->rejection_reason);
        }

        return $mail
            ->line('You are welcome to make the necessary changes and resubmit.')
            ->action('Edit & Resubmit', $editUrl)
            ->line('If you have any questions, please contact our support team.');
    }
}
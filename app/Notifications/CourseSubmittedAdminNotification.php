<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Concerns\LogsEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseSubmittedAdminNotification extends Notification implements ShouldQueue
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

        $reviewUrl = config('app.admin_url') . '/courses/pending/' . $this->course->id;

        return (new MailMessage)
            ->subject('New Course Submitted for Review')
            ->greeting('Hello Admin,')
            ->line('A new course has been submitted and is awaiting your review.')
            ->line('**Course:** ' . $this->course->title)
            ->line('**Instructor:** ' . $this->course->author->name)
            ->line('**Category:** ' . $this->course->category->name)
            ->line('**Submitted:** ' . $this->course->submitted_at->toFormattedDateString())
            ->action('Review Course', $reviewUrl)
            ->line('Please review within 3–5 business days.');
    }
}
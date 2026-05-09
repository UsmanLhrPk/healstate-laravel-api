<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Concerns\LogsEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseEnrolledNotification extends Notification implements ShouldQueue
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
        $this->log('course_enrolled', $notifiable->id, $this->course->id);

        $learnUrl = config('app.url') . '/courses/' . $this->course->slug . '/learn';

        return (new MailMessage)
            ->subject('You\'re Enrolled in ' . $this->course->title)
            ->greeting('Welcome, ' . $notifiable->name . '!')
            ->line('You are now enrolled in the following course:')
            ->line('**Course:** ' . $this->course->title)
            ->line('**Instructor:** ' . $this->course->author->name)
            ->action('Start Learning', $learnUrl)
            ->line('Track your progress from your dashboard at any time.');
    }
}
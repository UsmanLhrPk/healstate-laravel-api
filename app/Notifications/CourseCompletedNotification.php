<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Concerns\LogsEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseCompletedNotification extends Notification implements ShouldQueue
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
        $this->log('course_completed', $notifiable->id, $this->course->id);

        $reviewUrl = config('app.url') . '/courses/' . $this->course->slug . '?review=1';

        return (new MailMessage)
            ->subject('You\'ve Completed ' . $this->course->title . '!')
            ->greeting('Congratulations, ' . $notifiable->name . '!')
            ->line('You have successfully completed the following course:')
            ->line('**Course:** ' . $this->course->title)
            ->line('**Instructor:** ' . $this->course->author->name)
            ->line('We\'d love to hear what you thought — your review helps other students find great courses.')
            ->action('Leave a Review', $reviewUrl);
    }
}
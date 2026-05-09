<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Concerns\LogsEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseApprovedNotification extends Notification implements ShouldQueue
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
        $this->log('course_approved', $notifiable->id, $this->course->id);

        $courseUrl = config('app.url') . '/courses/' . $this->course->slug;

        return (new MailMessage)
            ->subject('Your Course is Now Live!')
            ->greeting('Congratulations ' . $notifiable->name . '!')
            ->line('Your course has been approved and is now live in the HealState catalog.')
            ->line('**Course:** ' . $this->course->title)
            ->action('View Your Course', $courseUrl)
            ->line('Students can now find and enroll in your course. Good luck!');
    }
}
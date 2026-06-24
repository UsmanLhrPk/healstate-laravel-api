<?php

namespace App\Notifications\Concerns;

use App\Models\EmailNotification;

trait LogsEmailNotification
{
    protected function log(string $type, int $userId, ?int $courseId = null): void
    {
        EmailNotification::create([
            'user_id'          => $userId,
            'email_type'       => $type,
            'related_course_id'=> $courseId,
            'sent_at'          => now(),
        ]);
    }
}
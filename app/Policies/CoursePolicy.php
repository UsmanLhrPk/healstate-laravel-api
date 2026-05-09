<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function update(User $user, Course $course): bool
{
    if ((int) $user->id !== (int) $course->user_id) {
        return false;
    }

    // Instructor cannot edit once submitted or live
    $lockedStatuses = [Course::STATUS_PENDING, Course::STATUS_PUBLISHED];

    return ! in_array($course->status, $lockedStatuses);
}

    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }
}

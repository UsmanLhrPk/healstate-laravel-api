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

        // Keep live courses locked, but allow creators to continue editing drafts
        // and pending submissions until the workflow is finalized.
        $lockedStatuses = [Course::STATUS_PUBLISHED];

        return ! in_array($course->status, $lockedStatuses, true);
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }
}

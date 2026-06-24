<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use App\Models\CourseMedia;
use App\Models\CourseReview;
use App\Models\User;
use App\Notifications\CourseApprovedNotification;
use App\Notifications\CourseCompletedNotification;
use App\Notifications\CourseEnrolledNotification;
use App\Notifications\CourseRejectedNotification;
use App\Notifications\CourseSubmittedAdminNotification;
use App\Notifications\CourseSubmittedInstructorNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseService
{
    public function __construct(
        protected CourseMediaService $mediaService
    ) {}

    // ─────────────────────────────────────────────────────────
    // PUBLIC COURSE BROWSING
    // ─────────────────────────────────────────────────────────

    public function getPublishedCourses(array $filters = [], ?User $user = null): LengthAwarePaginator
    {
        $query = Course::with(['author', 'category', 'subcategories'])
            ->withCount(['modules', 'enrollments'])
            ->published();

        if (! empty($filters['search'])) {
            $query->where(function ($builder) use ($filters) {
                $builder
                    ->where('title', 'like', '%'.$filters['search'].'%')
                    ->orWhere('subtitle', 'like', '%'.$filters['search'].'%')
                    ->orWhere('description', 'like', '%'.$filters['search'].'%');
            });
        }

        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (! empty($filters['difficulty_level'])) {
            $query->where('difficulty_level', $filters['difficulty_level']);
        }

        if (isset($filters['is_featured'])) {
            $query->where('is_featured', (bool) $filters['is_featured']);
        }

        match ($filters['sort'] ?? 'latest') {
            'price_low' => $query->orderBy('price'),
            'price_high' => $query->orderByDesc('price'),
            'popular' => $query->orderByDesc('total_enrollments'),
            'rating' => $query->orderByDesc('average_rating'),
            default => $query->latest('published_at'),
        };

        if ($user) {
            $query->with([
                'enrollments' => fn ($q) => $q
                    ->where('user_id', $user->id)
                    ->with(['course.modules.lessons', 'lessonProgress']),
            ]);
        }

        return $query->paginate($filters['per_page'] ?? 15);
    }

    public function getCreatorCourses(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return Course::with(['author', 'category', 'subcategories', 'outcomes', 'requirements', 'modules.lessons'])
            ->withCount(['modules', 'enrollments'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);
    }

    public function getInstructorCourseById(User $user, int $courseId): ?Course
    {
        $course = Course::where('user_id', $user->id)
            ->whereKey($courseId)
            ->first();

        if (! $course) {
            return null;
        }

        return $this->getCourseDetails($course, $user);
    }

    public function getCourseDetails(Course $course, ?User $user = null): Course
    {
        $course->load([
            'author',
            'category',
            'subcategories',
            'outcomes',
            'requirements',
            'modules.lessons',
        ])->loadCount([
            'modules',
            'enrollments',
        ]);

        $course->lessons_count = $course->modules->sum(fn ($module) => $module->lessons->count());

        $enrollment = null;

        if ($user) {
            $course->load([
                'enrollments' => fn ($query) => $query
                    ->where('user_id', $user->id)
                    ->with(['course.modules.lessons', 'lessonProgress']),
            ]);

            $enrollment = $course->enrollments->first();
        }

        $this->applyLessonAccessMetadata($course, $user, $enrollment);

        return $course;
    }

    // ─────────────────────────────────────────────────────────
    // COURSE CRUD
    // ─────────────────────────────────────────────────────────

    public function createCourse(User $user, array $data): Course
    {
        return DB::transaction(function () use ($user, $data) {
            $status = $data['status'] ?? Course::STATUS_DRAFT;

            $course = Course::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'slug' => $this->generateUniqueSlug($data['title']),
                'subtitle' => $data['subtitle'] ?? null,
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'thumbnail_path' => null,
                'promo_video_url' => $data['promo_video_url'] ?? null,
                'difficulty_level' => $data['difficulty_level'],
                'language' => $data['language'] ?? 'en',
                'pricing_type' => $data['pricing_type'] ?? (($data['price'] ?? 0) > 0 ? 'paid' : 'free'),
                'price' => $data['price'] ?? null,
                'discount_price' => $data['discount_price'] ?? null,
                'is_featured' => $data['is_featured'] ?? false,
                'status' => $status,
                'submitted_at' => $status === Course::STATUS_PENDING ? now() : null,
                'published_at' => $status === Course::STATUS_PUBLISHED ? now() : null,
            ]);

            $this->syncSubcategories($course, $data['subcategory_ids'] ?? []);
            $this->syncOutcomes($course, $data['outcomes'] ?? []);
            $this->syncRequirements($course, $data['requirements'] ?? []);
            $this->syncModules($course, $data['modules'] ?? []);
            $this->refreshCourseDuration($course);

            $result = $this->getCourseDetails($course);

            // Notify admin + instructor when submitted for review
            if ($status === Course::STATUS_PENDING) {
                $this->guardSubmittable($result);
                $this->notifySubmission($result);
            }

            if (! empty($data['thumbnail'])) {
                $this->mediaService->upload(
                    uploader: $user,
                    course: $course,
                    file: $data['thumbnail'],
                    mediaType: CourseMedia::TYPE_THUMBNAIL,
                );
                // syncModelPath() inside upload() already calls $course->update(['thumbnail_path' => ...])
                // so nothing extra needed here
            }

            return $result;
        });
    }

    public function updateCourse(Course $course, array $data): Course
    {
        return DB::transaction(function () use ($course, $data) {
            $previousStatus = $course->status;

            if (array_key_exists('thumbnail', $data) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete old media record + file if one exists
                $oldMedia = CourseMedia::where('course_id', $course->id)
                    ->where('media_type', CourseMedia::TYPE_THUMBNAIL)
                    ->latest('uploaded_at')
                    ->first();

                if ($oldMedia) {
                    $this->mediaService->delete($oldMedia, $course->author ?? $course->load('author')->author);
                }

                $this->mediaService->upload(
                    uploader: $course->author,
                    course: $course,
                    file: $data['thumbnail'],
                    mediaType: CourseMedia::TYPE_THUMBNAIL,
                );

                // Remove from $data so it doesn't hit $course->update() with a file object
                unset($data['thumbnail']);
            }

            if (! empty($data['title']) && $data['title'] !== $course->title) {
                $data['slug'] = $this->generateUniqueSlug($data['title'], $course->id);
            }

            $nextStatus = $data['status'] ?? $course->status;

            if ($nextStatus === Course::STATUS_PENDING && ! $course->submitted_at) {
                $data['submitted_at'] = now();
            }

            if ($nextStatus === Course::STATUS_PUBLISHED && ! $course->published_at) {
                $data['published_at'] = now();
            }

            if ($nextStatus !== Course::STATUS_PUBLISHED && array_key_exists('status', $data)) {
                $data['published_at'] = null;
            }

            $course->update(array_intersect_key($data, array_flip($course->getFillable())));

            if (array_key_exists('subcategory_ids', $data)) {
                $this->syncSubcategories($course, $data['subcategory_ids'] ?? []);
            }

            if (array_key_exists('outcomes', $data)) {
                $this->syncOutcomes($course, $data['outcomes'] ?? []);
            }

            if (array_key_exists('requirements', $data)) {
                $this->syncRequirements($course, $data['requirements'] ?? []);
            }

            if (array_key_exists('modules', $data)) {
                $this->syncModules($course, $data['modules'] ?? []);
            }

            $this->refreshCourseDuration($course->fresh('modules.lessons'));

            $result = $this->getCourseDetails($course->fresh());

            // Notify only on first transition into pending (not on repeated saves)
            if (
                $nextStatus === Course::STATUS_PENDING &&
                $previousStatus !== Course::STATUS_PENDING
            ) {
                $this->guardSubmittable($result);
                $this->notifySubmission($result);
            }

            return $result;
        });
    }

    public function deleteCourse(Course $course): bool
    {
        return DB::transaction(function () use ($course) {
            if ($course->thumbnail_path) {
                Storage::disk('public')->delete($course->thumbnail_path);
            }

            return $course->delete();
        });
    }

    public function submitCourseForReview(Course $course, User $user): Course
    {
        if ((int) $course->user_id !== (int) $user->id) {
            throw new \DomainException('You do not have permission to submit this course.');
        }

        if (! in_array($course->status, [Course::STATUS_DRAFT, Course::STATUS_REJECTED], true)) {
            throw new \DomainException('Only draft or rejected courses can be submitted for review.');
        }

        $detailedCourse = $this->getCourseDetails($course->fresh(), $user);

        $this->guardSubmittable($detailedCourse);

        Course::query()->whereKey($course->getKey())->update([
            'status' => Course::STATUS_PENDING,
            'submitted_at' => now(),
            'published_at' => null,
            'rejection_reason' => null,
        ]);

        $fresh = $this->getCourseDetails($course->fresh(), $user);

        $this->notifySubmission($fresh);

        return $fresh;
    }

    // ─────────────────────────────────────────────────────────
    // ADMIN COURSE MANAGEMENT
    // ─────────────────────────────────────────────────────────

    public function getAdminCourseList(array $filters = []): LengthAwarePaginator
    {
        $query = Course::with(['author', 'category'])
            ->withCount(['enrollments', 'modules'])
            ->latest();

        if (! empty($filters['search'])) {
            $query->where(function ($builder) use ($filters) {
                $builder
                    ->where('title', 'like', '%'.$filters['search'].'%')
                    ->orWhereHas('author', fn ($q) => $q->where('name', 'like', '%'.$filters['search'].'%')
                    );
            });
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        return $query->paginate($filters['per_page'] ?? 20);
    }

    public function getPendingCourses(int $perPage = 20): LengthAwarePaginator
    {
        return Course::with(['author', 'category'])
            ->withCount(['modules', 'enrollments'])
            ->where('status', Course::STATUS_PENDING)
            ->orderBy('submitted_at')
            ->paginate($perPage);
    }

    public function approveCourse(Course $course, User|Admin $reviewer): Course
    {
        if ($course->status !== Course::STATUS_PENDING) {
            throw new \DomainException('Only pending courses can be approved.');
        }

        $course->update([
            'status' => Course::STATUS_PUBLISHED,
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
            'published_at' => now(),
            'rejection_reason' => null,
        ]);

        $fresh = $this->getCourseDetails($course->fresh());

        $fresh->author->notify(new CourseApprovedNotification($fresh));

        return $fresh;
    }

    public function rejectCourse(Course $course, User|Admin $reviewer, ?string $reason = null): Course
    {
        if ($course->status !== Course::STATUS_PENDING) {
            throw new \DomainException('Only pending courses can be rejected.');
        }

        $course->update([
            'status' => Course::STATUS_REJECTED,
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
            'rejection_reason' => $reason,
            'published_at' => null,
        ]);

        $fresh = $this->getCourseDetails($course->fresh());

        $fresh->author->notify(new CourseRejectedNotification($fresh));

        return $fresh;
    }

    public function toggleFeatured(Course $course): Course
    {
        $course->update(['is_featured' => ! $course->is_featured]);

        return $course->fresh();
    }

    public function deactivateCourse(Course $course): Course
    {
        if ($course->status !== Course::STATUS_PUBLISHED) {
            throw new \DomainException('Only published courses can be deactivated.');
        }

        $course->update(['status' => Course::STATUS_ARCHIVED]);

        return $course->fresh();
    }

    public function adminDeleteCourse(Course $course): void
    {
        $notDeletable = [Course::STATUS_PUBLISHED, Course::STATUS_PENDING];

        if (in_array($course->status, $notDeletable)) {
            throw new \DomainException('Published or pending courses cannot be permanently deleted.');
        }

        if ($course->enrollments()->exists()) {
            throw new \DomainException('Courses with active enrollments cannot be deleted.');
        }

        DB::transaction(function () use ($course) {
            if ($course->thumbnail_path) {
                Storage::disk('public')->delete($course->thumbnail_path);
            }

            $course->delete();
        });
    }

    // ─────────────────────────────────────────────────────────
    // ENROLLMENT
    // ─────────────────────────────────────────────────────────

    public function enroll(User $user, Course $course): CourseEnrollment
    {
        if ((int) $course->user_id === (int) $user->id) {
            throw new \DomainException('You cannot enroll in your own course.');
        }

        return DB::transaction(function () use ($user, $course) {
            $enrollment = CourseEnrollment::firstOrCreate(
                [
                    'course_id' => $course->id,
                    'user_id' => $user->id,
                ],
                [
                    'enrollment_type' => $course->pricing_type === 'paid'
                        ? CourseEnrollment::TYPE_PAID
                        : CourseEnrollment::TYPE_FREE,
                    'amount_paid' => $course->pricing_type === 'paid'
                        ? ($course->discount_price ?? $course->price)
                        : null,
                    'progress_percent' => 0,
                    'is_completed' => false,
                    'enrolled_at' => now(),
                ]
            );

            $this->syncCourseEnrollmentStats($course);

            // Notify the student — load author so the notification can reference the instructor name
            $course->loadMissing('author');
            $user->notify(new CourseEnrolledNotification($course));

            return $this->getEnrollmentWithProgress($course->id, $user->id);
        });
    }

    public function getUserEnrollments(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return CourseEnrollment::with(['course.author', 'course.modules.lessons', 'lessonProgress'])
            ->where('user_id', $user->id)
            ->orderByDesc('enrolled_at')
            ->paginate($perPage);
    }

    // ─────────────────────────────────────────────────────────
    // LESSON ACCESS & PROGRESS
    // ─────────────────────────────────────────────────────────

    public function lessonBelongsToCourse(Course $course, CourseLesson $lesson): bool
    {
        return (int) $lesson->course_id === (int) $course->id;
    }

    public function getAccessibleLesson(Course $course, CourseLesson $lesson, ?User $user = null): ?CourseLesson
    {
        $lesson->loadMissing('module.course');

        $enrollment = null;

        if ($user) {
            $enrollment = CourseEnrollment::with('lessonProgress')
                ->where('course_id', $course->id)
                ->where('user_id', $user->id)
                ->first();
        }

        $canAccess = $this->canAccessLesson($course, $lesson, $user, $enrollment);

        if (! $canAccess) {
            return null;
        }

        $this->attachLessonMetadata($lesson, $course, $user, $enrollment, true);

        return $lesson;
    }

    public function updateLessonProgress(
        User $user,
        Course $course,
        CourseLesson $lesson,
        bool $isCompleted,
        ?float $watchPercent = null
    ): ?CourseEnrollment {
        $enrollment = CourseEnrollment::with(['lessonProgress', 'course.modules.lessons'])
            ->where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->first();

        if (! $enrollment) {
            return null;
        }

        DB::transaction(function () use ($enrollment, $lesson, $isCompleted, $watchPercent, $course, $user) {
            // Auto-complete video lessons at 80% watch progress
            $resolvedCompleted = $isCompleted;
            if (
                ! $resolvedCompleted &&
                $lesson->lesson_type === 'video' &&
                $watchPercent !== null &&
                $watchPercent >= 80
            ) {
                $resolvedCompleted = true;
            }

            $progress = $enrollment->lessonProgress()->updateOrCreate(
                ['lesson_id' => $lesson->id],
                [
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'is_completed' => $resolvedCompleted,
                    'completed_at' => $resolvedCompleted ? now() : null,
                    'watch_percent' => $watchPercent,
                ]
            );

            // If explicitly unmarking as complete, clear the timestamp
            if (! $resolvedCompleted && $progress->completed_at) {
                $progress->completed_at = null;
                $progress->watch_percent = $watchPercent;
                $progress->save();
            }

            $enrollment->last_accessed_at = now();
            $enrollment->save();

            $this->refreshEnrollmentProgress($enrollment);
        });

        return $this->getEnrollmentWithProgress($course->id, $user->id);
    }

    public function getEnrollmentWithProgress(int $courseId, int $userId): ?CourseEnrollment
    {
        return CourseEnrollment::with([
            'course.author',
            'course.modules.lessons',
            'lessonProgress',
            'user',  // needed for completion notification dispatch
        ])->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->first();
    }

    // ─────────────────────────────────────────────────────────
    // REVIEWS
    // ─────────────────────────────────────────────────────────

    public function getReviews(Course $course, int $perPage = 15): LengthAwarePaginator
    {
        return CourseReview::with('user')
            ->where('course_id', $course->id)
            ->where('is_visible', true)
            ->latest()
            ->paginate($perPage);
    }

    public function storeReview(User $user, Course $course, array $data): CourseReview
    {
        $enrollment = CourseEnrollment::where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($enrollment->progress_percent < 50) {
            throw new \DomainException('You must complete at least 50% of the course to leave a review.');
        }

        if ($course->user_id === $user->id) {
            throw new \DomainException('You cannot review your own course.');
        }

        // Block resubmission if the student already deleted once
        if ($enrollment->review_deletion_count >= 1) {
            $alreadyHasReview = CourseReview::where('course_id', $course->id)
                ->where('user_id', $user->id)
                ->exists();

            if ($alreadyHasReview) {
                throw new \DomainException('You have already used your one resubmission.');
            }
        }

        return DB::transaction(function () use ($user, $course, $enrollment, $data) {
            $review = CourseReview::create([
                'course_id' => $course->id,
                'user_id' => $user->id,
                'enrollment_id' => $enrollment->id,
                'rating' => $data['rating'],
                'review_text' => $data['review_text'] ?? null,
            ]);

            $this->refreshCourseRating($course);

            return $review->load('user');
        });
    }

    public function deleteReview(User $user, Course $course): void
    {
        $review = CourseReview::where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $enrollment = $review->enrollment;

        // Guard: only one deletion/resubmission allowed per enrollment
        if ($enrollment->review_deletion_count >= 1) {
            throw new \DomainException('You have already used your one resubmission.');
        }

        DB::transaction(function () use ($review, $enrollment, $course) {
            // Track the deletion on the enrollment so the count survives after the review row is gone
            $enrollment->increment('review_deletion_count');

            $review->delete();
            $this->refreshCourseRating($course);
        });
    }

    public function adminRemoveReview(CourseReview $review): void
    {
        DB::transaction(function () use ($review) {
            $course = $review->course;
            $review->delete();
            $this->refreshCourseRating($course);
        });
    }

    // ─────────────────────────────────────────────────────────
    // PRIVATE HELPERS
    // ─────────────────────────────────────────────────────────

    private function notifySubmission(Course $course): void
    {
        // Tell the instructor their course is under review
        $course->author->notify(new CourseSubmittedInstructorNotification($course));

        // Alert all admins so they can queue a review
        $admins = Admin::all();
        Notification::send($admins, new CourseSubmittedAdminNotification($course));
    }

    private function syncSubcategories(Course $course, array $subcategoryIds): void
    {
        $course->subcategories()->sync($subcategoryIds);
    }

    private function syncOutcomes(Course $course, array $outcomes): void
    {
        $course->outcomes()->delete();

        foreach (array_values($outcomes) as $index => $outcomeText) {
            $course->outcomes()->create([
                'outcome_text' => $outcomeText,
                'display_order' => $index,
            ]);
        }
    }

    private function syncRequirements(Course $course, array $requirements): void
    {
        $course->requirements()->delete();

        foreach (array_values($requirements) as $index => $requirementText) {
            $course->requirements()->create([
                'requirement_text' => $requirementText,
                'display_order' => $index,
            ]);
        }
    }

    private function syncModules(Course $course, array $modules): void
    {
        $moduleIds = [];

        foreach (array_values($modules) as $moduleIndex => $moduleData) {
            $module = $course->modules()->updateOrCreate(
                ['id' => $moduleData['id'] ?? null],
                [
                    'title' => $moduleData['title'],
                    'description' => $moduleData['description'] ?? null,
                    'display_order' => $moduleIndex,
                ]
            );

            $moduleIds[] = $module->id;
            $lessonIds = [];

            foreach (array_values($moduleData['lessons'] ?? []) as $lessonIndex => $lessonData) {
                $lesson = $module->lessons()->updateOrCreate(
                    ['id' => $lessonData['id'] ?? null],
                    [
                        'course_id' => $course->id,
                        'title' => $lessonData['title'],
                        'lesson_type' => $lessonData['lesson_type'],
                        'video_url' => $lessonData['video_url'] ?? null,
                        'text_content' => $lessonData['text_content'] ?? null,
                        'pdf_path' => $lessonData['pdf_path'] ?? null,
                        'duration_minutes' => $lessonData['duration_minutes'] ?? 0,
                        'is_preview' => $lessonData['is_preview'] ?? false,
                        'display_order' => $lessonIndex,
                    ]
                );

                $lessonIds[] = $lesson->id;
            }

            $module->lessons()->whereNotIn('id', $lessonIds ?: [0])->delete();
        }

        $course->modules()->whereNotIn('id', $moduleIds ?: [0])->delete();
    }

    private function refreshCourseDuration(Course $course): void
    {
        $course->loadMissing('modules.lessons');

        $duration = $course->modules
            ->flatMap(fn ($module) => $module->lessons)
            ->sum('duration_minutes');

        $course->update(['total_duration_minutes' => $duration]);
    }

    private function refreshEnrollmentProgress(CourseEnrollment $enrollment): void
    {
        $enrollment->loadMissing('course.modules.lessons');
        $enrollment->load('lessonProgress');

        $totalLessons = $enrollment->course->modules->sum(fn ($module) => $module->lessons->count());
        $completedLessons = $enrollment->lessonProgress->where('is_completed', true)->count();

        $percentage = $totalLessons > 0
            ? round(($completedLessons / $totalLessons) * 100, 2)
            : 0;

        $isComplete = $totalLessons > 0 && $completedLessons === $totalLessons;

        $enrollment->update([
            'progress_percent' => $percentage,
            'is_completed' => $isComplete,
            'completed_at' => $isComplete ? now() : null,
        ]);

        // Notify the student exactly once when they finish all lessons
        if ($isComplete) {
            $enrollment->loadMissing('course.author', 'user');
            $enrollment->user->notify(new CourseCompletedNotification($enrollment->course));
        }
    }

    private function syncCourseEnrollmentStats(Course $course): void
    {
        $course->update([
            'total_enrollments' => $course->enrollments()->count(),
        ]);
    }

    private function applyLessonAccessMetadata(Course $course, ?User $user, ?CourseEnrollment $enrollment): void
    {
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                $canAccess = $this->canAccessLesson($course, $lesson, $user, $enrollment);
                $this->attachLessonMetadata($lesson, $course, $user, $enrollment, $canAccess);
            }
        }
    }

    private function canAccessLesson(
        Course $course,
        CourseLesson $lesson,
        ?User $user,
        ?CourseEnrollment $enrollment
    ): bool {
        if ($lesson->is_preview) {
            return true;
        }

        if ($user && $course->user_id === $user->id) {
            return true;
        }

        return (bool) $enrollment;
    }

    private function attachLessonMetadata(
        CourseLesson $lesson,
        Course $course,
        ?User $user,
        ?CourseEnrollment $enrollment,
        bool $canAccess
    ): void {
        $progressRecord = $enrollment?->lessonProgress?->firstWhere('lesson_id', $lesson->id);

        $lesson->setAttribute('can_access', $canAccess);
        $lesson->setAttribute('is_locked', ! $canAccess);
        $lesson->setAttribute('is_completed', (bool) optional($progressRecord)->is_completed);
        $lesson->setAttribute('completed_at', optional($progressRecord)->completed_at);
        $lesson->setAttribute('watch_percent', optional($progressRecord)->watch_percent);

        if (! $canAccess) {
            $lesson->setAttribute('text_content', null);
            $lesson->setAttribute('video_path', null);
            $lesson->setAttribute('video_url', null);
            $lesson->setAttribute('pdf_path', null);
        }
    }

    private function storeThumbnail($thumbnail): ?string
    {
        if (! $thumbnail instanceof \Illuminate\Http\UploadedFile) {
            return null;
        }

        return $thumbnail->store('courses', 'public');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Course::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    private function refreshCourseRating(Course $course): void
    {
        $stats = CourseReview::where('course_id', $course->id)
            ->where('is_visible', true)
            ->selectRaw('AVG(rating) as avg_rating, COUNT(*) as total')
            ->first();

        $course->update([
            'average_rating' => $stats->avg_rating ? round($stats->avg_rating, 2) : null,
            'total_reviews' => $stats->total ?? 0,
        ]);
    }

    private function guardSubmittable(Course $course): void
    {
        $course->loadMissing('modules.lessons');

        $hasContent = $course->modules->contains(
            fn ($module) => $module->lessons->isNotEmpty()
        );

        if (! $hasContent) {
            throw new \DomainException(
                'A course must have at least one module with at least one lesson before it can be submitted.'
            );
        }
    }
}

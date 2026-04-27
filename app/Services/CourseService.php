<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseService
{
    public function getPublishedCourses(array $filters = [], ?User $user = null): LengthAwarePaginator
    {
        $query = Course::with(['author', 'category', 'subcategories'])
            ->withCount(['modules', 'enrollments'])
            ->published();

        if (! empty($filters['search'])) {
            $query->where(function ($builder) use ($filters) {
                $builder
                    ->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('subtitle', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
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
            $query->with(['enrollments' => fn ($q) => $q->where('user_id', $user->id)->with(['course.modules.lessons', 'lessonProgress'])]);
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

    public function createCourse(User $user, array $data): Course
    {
        return DB::transaction(function () use ($user, $data) {
            $course = Course::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'slug' => $this->generateUniqueSlug($data['title']),
                'subtitle' => $data['subtitle'] ?? null,
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'thumbnail_path' => $this->storeThumbnail($data['thumbnail'] ?? null),
                'promo_video_url' => $data['promo_video_url'] ?? null,
                'difficulty_level' => $data['difficulty_level'],
                'language' => $data['language'] ?? 'en',
                'pricing_type' => $data['pricing_type'] ?? (($data['price'] ?? 0) > 0 ? 'paid' : 'free'),
                'price' => $data['price'] ?? null,
                'discount_price' => $data['discount_price'] ?? null,
                'is_featured' => $data['is_featured'] ?? false,
                'status' => $data['status'] ?? Course::STATUS_DRAFT,
                'submitted_at' => ($data['status'] ?? Course::STATUS_DRAFT) === Course::STATUS_PENDING ? now() : null,
                'published_at' => ($data['status'] ?? Course::STATUS_DRAFT) === Course::STATUS_PUBLISHED ? now() : null,
            ]);

            $this->syncSubcategories($course, $data['subcategory_ids'] ?? []);
            $this->syncOutcomes($course, $data['outcomes'] ?? []);
            $this->syncRequirements($course, $data['requirements'] ?? []);
            $this->syncModules($course, $data['modules'] ?? []);
            $this->refreshCourseDuration($course);

            return $this->getCourseDetails($course);
        });
    }

    public function updateCourse(Course $course, array $data): Course
    {
        return DB::transaction(function () use ($course, $data) {
            if (array_key_exists('thumbnail', $data)) {
                if ($course->thumbnail_path) {
                    Storage::disk('public')->delete($course->thumbnail_path);
                }

                $data['thumbnail_path'] = $this->storeThumbnail($data['thumbnail']);
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

            return $this->getCourseDetails($course->fresh());
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

    public function enroll(User $user, Course $course): CourseEnrollment
    {
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
        bool $isCompleted
    ): ?CourseEnrollment {
        $enrollment = CourseEnrollment::with(['lessonProgress', 'course.modules.lessons'])
            ->where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->first();

        if (! $enrollment) {
            return null;
        }

        DB::transaction(function () use ($enrollment, $lesson, $isCompleted, $course, $user) {
            $progress = $enrollment->lessonProgress()->updateOrCreate(
                ['lesson_id' => $lesson->id],
                [
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'is_completed' => $isCompleted,
                    'completed_at' => $isCompleted ? now() : null,
                ]
            );

            if (! $isCompleted && $progress->completed_at) {
                $progress->completed_at = null;
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
        ])->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->first();
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
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

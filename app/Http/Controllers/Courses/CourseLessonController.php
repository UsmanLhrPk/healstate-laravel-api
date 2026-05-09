<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\UpdateCourseLessonProgressRequest;
use App\Http\Resources\Courses\CourseEnrollmentResource;
use App\Http\Resources\Courses\CourseLessonResource;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseLessonController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    public function show(Request $request, Course $course, CourseLesson $lesson): JsonResponse
    {
        if (! $this->courseService->lessonBelongsToCourse($course, $lesson)) {
            return response()->json([
                'message' => 'Lesson not found for this course.',
            ], 404);
        }

        $lesson = $this->courseService->getAccessibleLesson($course, $lesson, $request->user());

        if (! $lesson) {
            return response()->json([
                'message' => 'You do not have access to this lesson.',
            ], 403);
        }

        return response()->json([
            'data' => new CourseLessonResource($lesson),
        ]);
    }

    public function updateProgress(
        UpdateCourseLessonProgressRequest $request,
        Course $course,
        CourseLesson $lesson
    ): JsonResponse {
        if (! $this->courseService->lessonBelongsToCourse($course, $lesson)) {
            return response()->json([
                'message' => 'Lesson not found for this course.',
            ], 404);
        }

        $enrollment = $this->courseService->updateLessonProgress(
            $request->user(),
            $course,
            $lesson,
            $request->boolean('is_completed'),
            $request->input('watch_percent') !== null
                ? (float) $request->input('watch_percent')
                : null,
        );

        if (! $enrollment) {
            return response()->json([
                'message' => 'You must enroll in this course before updating lesson progress.',
            ], 422);
        }

        return response()->json([
            'message' => 'Lesson progress updated successfully',
            'data' => new CourseEnrollmentResource($enrollment),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use App\Http\Resources\Courses\CourseEnrollmentResource;
use App\Http\Resources\Courses\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Courses
 */
class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $courses = $this->courseService->getPublishedCourses([
            'search' => $request->get('search'),
            'category_id' => $request->get('category_id'),
            'difficulty_level' => $request->get('difficulty_level'),
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : null,
            'sort' => $request->get('sort', 'latest'),
            'per_page' => min((int) $request->get('per_page', 15), 100),
        ], $request->user());

        return response()->json([
            'data' => CourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
        ]);
    }

    public function show(Request $request, Course $course): JsonResponse
    {
        if ($course->status !== Course::STATUS_PUBLISHED && optional($request->user())->id !== $course->user_id) {
            return response()->json([
                'message' => 'Course not found.',
            ], 404);
        }

        $course = $this->courseService->getCourseDetails($course, $request->user());

        return response()->json([
            'data' => new CourseResource($course),
        ]);
    }

    public function myCourses(Request $request): JsonResponse
    {
        $courses = $this->courseService->getCreatorCourses(
            $request->user(),
            min((int) $request->get('per_page', 15), 100)
        );

        return response()->json([
            'data' => CourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
        ]);
    }

    public function store(StoreCourseRequest $request): JsonResponse
    {
        $course = $this->courseService->createCourse($request->user(), $request->validated());

        return response()->json([
            'message' => 'Course created successfully',
            'data' => new CourseResource($course),
        ], 201);
    }

    public function update(UpdateCourseRequest $request, Course $course): JsonResponse
    {
        $course = $this->courseService->updateCourse($course, $request->validated());

        return response()->json([
            'message' => 'Course updated successfully',
            'data' => new CourseResource($course),
        ]);
    }

    public function destroy(Course $course): JsonResponse
    {
        $this->authorize('delete', $course);
        $this->courseService->deleteCourse($course);

        return response()->json([
            'message' => 'Course deleted successfully',
        ]);
    }

    public function enroll(Request $request, Course $course): JsonResponse
    {
        if ($course->status !== Course::STATUS_PUBLISHED) {
            return response()->json([
                'message' => 'Only published courses can be enrolled in.',
            ], 422);
        }

        $enrollment = $this->courseService->enroll($request->user(), $course);

        return response()->json([
            'message' => 'Course enrollment successful',
            'data' => new CourseEnrollmentResource($enrollment),
        ], 201);
    }

    public function myEnrollments(Request $request): JsonResponse
    {
        $enrollments = $this->courseService->getUserEnrollments(
            $request->user(),
            min((int) $request->get('per_page', 15), 100)
        );

        return response()->json([
            'data' => CourseEnrollmentResource::collection($enrollments),
            'meta' => [
                'current_page' => $enrollments->currentPage(),
                'last_page' => $enrollments->lastPage(),
                'per_page' => $enrollments->perPage(),
                'total' => $enrollments->total(),
            ],
        ]);
    }

    public function myEnrollment(Request $request, Course $course): JsonResponse
    {
        $enrollment = $this->courseService->getEnrollmentWithProgress($course->id, $request->user()->id);

        if (! $enrollment) {
            return response()->json([
                'message' => 'You are not enrolled in this course.',
            ], 404);
        }

        return response()->json([
            'data' => new CourseEnrollmentResource($enrollment),
        ]);
    }
}

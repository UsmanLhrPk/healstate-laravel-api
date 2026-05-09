<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\ReviewCourseRequest;
use App\Http\Resources\Courses\AdminCourseResource;
use App\Http\Resources\Courses\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    // GET /admin/courses
    public function index(Request $request): JsonResponse
    {
        $courses = $this->courseService->getAdminCourseList([
            'search'      => $request->get('search'),
            'status'      => $request->get('status'),
            'category_id' => $request->get('category_id'),
            'per_page'    => min((int) $request->get('per_page', 20), 100),
        ]);

        return response()->json([
            'data' => AdminCourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page'    => $courses->lastPage(),
                'per_page'     => $courses->perPage(),
                'total'        => $courses->total(),
            ],
        ]);
    }

    // GET /admin/courses/pending
    public function pending(Request $request): JsonResponse
    {
        $courses = $this->courseService->getPendingCourses(
            min((int) $request->get('per_page', 20), 100)
        );

        return response()->json([
            'data' => AdminCourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page'    => $courses->lastPage(),
                'per_page'     => $courses->perPage(),
                'total'        => $courses->total(),
            ],
        ]);
    }

    // GET /admin/courses/{course}
    public function show(Course $course): JsonResponse
    {
        $course = $this->courseService->getCourseDetails($course);

        return response()->json([
            'data' => new CourseResource($course), // full detail view
        ]);
    }

    // POST /admin/courses/{course}/approve
    public function approve(Request $request, Course $course): JsonResponse
    {
        try {
            $course = $this->courseService->approveCourse($course, $request->user());
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Course approved and published.',
            'data'    => new AdminCourseResource($course),
        ]);
    }

    // POST /admin/courses/{course}/reject
    public function reject(ReviewCourseRequest $request, Course $course): JsonResponse
    {
        try {
            $course = $this->courseService->rejectCourse(
                $course,
                $request->user(),
                $request->validated('rejection_reason')
            );
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Course rejected.',
            'data'    => new AdminCourseResource($course),
        ]);
    }

    // PATCH /admin/courses/{course}/feature
    public function toggleFeatured(Course $course): JsonResponse
    {
        $course = $this->courseService->toggleFeatured($course);

        return response()->json([
            'message'     => $course->is_featured ? 'Course featured.' : 'Course unfeatured.',
            'is_featured' => $course->is_featured,
        ]);
    }

    // PATCH /admin/courses/{course}/deactivate
    public function deactivate(Course $course): JsonResponse
    {
        try {
            $course = $this->courseService->deactivateCourse($course);
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Course deactivated. Enrolled students retain access.',
            'data'    => new AdminCourseResource($course),
        ]);
    }

    // DELETE /admin/courses/{course}
    public function destroy(Course $course): JsonResponse
    {
        try {
            $this->courseService->adminDeleteCourse($course);
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['message' => 'Course permanently deleted.']);
    }
}
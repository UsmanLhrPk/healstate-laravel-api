<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreCourseReviewRequest;
use App\Http\Resources\Courses\CourseReviewResource;
use App\Models\Course;
use App\Models\CourseReview;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseReviewController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    // GET /courses/{course}/reviews
    public function index(Request $request, Course $course): JsonResponse
    {
        $reviews = $this->courseService->getReviews(
            $course,
            min((int) $request->get('per_page', 15), 100)
        );

        return response()->json([
            'data' => CourseReviewResource::collection($reviews),
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'last_page'    => $reviews->lastPage(),
                'per_page'     => $reviews->perPage(),
                'total'        => $reviews->total(),
            ],
        ]);
    }

    // POST /courses/{course}/reviews
    public function store(StoreCourseReviewRequest $request, Course $course): JsonResponse
    {
        try {
            $review = $this->courseService->storeReview(
                $request->user(),
                $course,
                $request->validated()
            );
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Review submitted successfully.',
            'data'    => new CourseReviewResource($review),
        ], 201);
    }

    // DELETE /courses/{course}/reviews
    public function destroy(Request $request, Course $course): JsonResponse
    {
        try {
            $this->courseService->deleteReview($request->user(), $course);
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['message' => 'Review deleted successfully.']);
    }

    // DELETE /admin/courses/reviews/{review}  (admin)
    public function adminDestroy(CourseReview $review): JsonResponse
    {
        $this->courseService->adminRemoveReview($review);

        return response()->json(['message' => 'Review removed.']);
    }
}
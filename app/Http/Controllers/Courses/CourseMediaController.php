<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\UploadCourseMediaRequest;
use App\Http\Resources\Courses\CourseMediaResource;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\CourseMedia;
use App\Services\CourseMediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseMediaController extends Controller
{
    public function __construct(
        protected CourseMediaService $mediaService
    ) {}

    // GET /courses/{course}/media
    public function index(Course $course): JsonResponse
    {
        $media = $this->mediaService->listForCourse($course);

        return response()->json([
            'data' => CourseMediaResource::collection($media),
        ]);
    }

    // POST /courses/{course}/media  (thumbnail, promo_video, attachment)
    public function store(UploadCourseMediaRequest $request, Course $course): JsonResponse
    {
        try {
            $media = $this->mediaService->upload(
                uploader:  $request->user(),
                course:    $course,
                file:      $request->file('file'),
                mediaType: $request->input('media_type'),
            );
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'File uploaded successfully.',
            'data'    => new CourseMediaResource($media),
        ], 201);
    }

    // POST /courses/{course}/lessons/{lesson}/media  (lesson_video, lesson_pdf)
    public function storeForLesson(
        UploadCourseMediaRequest $request,
        Course $course,
        CourseLesson $lesson
    ): JsonResponse {
        try {
            $media = $this->mediaService->upload(
                uploader:  $request->user(),
                course:    $course,
                file:      $request->file('file'),
                mediaType: $request->input('media_type'),
                lesson:    $lesson,
            );
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Lesson file uploaded successfully.',
            'data'    => new CourseMediaResource($media),
        ], 201);
    }

    // DELETE /courses/media/{media}
    public function destroy(Request $request, CourseMedia $media): JsonResponse
    {
        try {
            $this->mediaService->delete($media, $request->user());
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['message' => 'File deleted successfully.']);
    }
}
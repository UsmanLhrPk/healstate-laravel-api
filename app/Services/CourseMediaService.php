<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\CourseMedia;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseMediaService
{
    // ── Storage folder map per type ──────────────────────────

    private const FOLDERS = [
        CourseMedia::TYPE_THUMBNAIL    => 'courses/thumbnails',
        CourseMedia::TYPE_PROMO_VIDEO  => 'courses/promo-videos',
        CourseMedia::TYPE_LESSON_VIDEO => 'courses/lesson-videos',
        CourseMedia::TYPE_LESSON_PDF   => 'courses/lesson-pdfs',
        CourseMedia::TYPE_ATTACHMENT   => 'courses/attachments',
    ];

    // ─────────────────────────────────────────────────────────

    public function upload(
        User $uploader,
        Course $course,
        UploadedFile $file,
        string $mediaType,
        ?CourseLesson $lesson = null
    ): CourseMedia {
        $this->guardLessonType($mediaType, $lesson);
        $this->guardCourseOwnership($course, $uploader);

        $folder   = self::FOLDERS[$mediaType];
        $filename = $this->sanitizedFilename($file);
        $path     = $file->storeAs($folder, $filename, 'public');

        $media = CourseMedia::create([
            'course_id'        => $course->id,
            'lesson_id'        => $lesson?->id,
            'uploader_id'      => $uploader->id,
            'media_type'       => $mediaType,
            'file_name'        => $file->getClientOriginalName(),
            'file_path'        => $path,
            'file_size'        => $file->getSize(),
            'mime_type'        => $file->getMimeType(),
            'duration_seconds' => $this->extractDuration($path, $mediaType),
            'uploaded_at'      => now(),
        ]);

        // Keep course/lesson columns in sync for the most recent upload of each type
        $this->syncModelPath($course, $lesson, $mediaType, $path, $media->duration_seconds);

        return $media->load('uploader');
    }

    public function delete(CourseMedia $media, User $actor): void
    {
        $this->guardCourseOwnership($media->course, $actor);

        Storage::disk('public')->delete($media->file_path);

        // Null out the synced column on course/lesson if this file is still the active one
        $this->clearModelPath($media);

        $media->delete();
    }

    public function listForCourse(Course $course): \Illuminate\Database\Eloquent\Collection
    {
        return CourseMedia::with('uploader')
            ->where('course_id', $course->id)
            ->orderByDesc('uploaded_at')
            ->get();
    }

    // ── Helpers ──────────────────────────────────────────────

    /**
     * Lesson-scoped types must come with a lesson; course-scoped types must not.
     */
    private function guardLessonType(string $type, ?CourseLesson $lesson): void
    {
        $lessonTypes = [
            CourseMedia::TYPE_LESSON_VIDEO,
            CourseMedia::TYPE_LESSON_PDF,
        ];

        if (in_array($type, $lessonTypes) && ! $lesson) {
            throw new \DomainException('A lesson is required for this media type.');
        }

        if (! in_array($type, $lessonTypes) && $lesson) {
            throw new \DomainException('This media type cannot be attached to a lesson.');
        }
    }

    private function guardCourseOwnership(Course $course, User $user): void
    {
        if ((int) $course->user_id !== (int) $user->id) {
            throw new \DomainException('You do not own this course.');
        }
    }

    private function sanitizedFilename(UploadedFile $file): string
    {
        $name      = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        return Str::slug($name) . '_' . uniqid() . '.' . $extension;
    }

    /**
     * Try to extract video duration via ffprobe.
     * Falls back to null gracefully if ffprobe is unavailable.
     */
    private function extractDuration(string $storagePath, string $mediaType): ?int
    {
        if (! in_array($mediaType, [CourseMedia::TYPE_PROMO_VIDEO, CourseMedia::TYPE_LESSON_VIDEO])) {
            return null;
        }

        $absolutePath = Storage::disk('public')->path($storagePath);

        if (! file_exists($absolutePath)) {
            return null;
        }

        try {
            $output = shell_exec(
                'ffprobe -v error -show_entries format=duration '
                . '-of default=noprint_wrappers=1:nokey=1 '
                . escapeshellarg($absolutePath)
                . ' 2>/dev/null'
            );

            return $output ? (int) round((float) trim($output)) : null;
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Keep the denormalized path columns on Course/CourseLesson in sync
     * so the rest of the app doesn't need to join course_media for the active file.
     */
    private function syncModelPath(
        Course $course,
        ?CourseLesson $lesson,
        string $type,
        string $path,
        ?int $durationSeconds
    ): void {
        match ($type) {
            CourseMedia::TYPE_THUMBNAIL   => $course->update(['thumbnail_path' => $path]),
            CourseMedia::TYPE_PROMO_VIDEO => $course->update(['promo_video_path' => $path]),

            CourseMedia::TYPE_LESSON_VIDEO => $lesson?->update([
                'video_path'       => $path,
                'duration_minutes' => $durationSeconds ? (int) ceil($durationSeconds / 60) : $lesson->duration_minutes,
            ]),

            CourseMedia::TYPE_LESSON_PDF  => $lesson?->update(['pdf_path' => $path]),

            default => null,
        };
    }

    private function clearModelPath(CourseMedia $media): void
    {
        $course = $media->course;
        $lesson = $media->lesson;

        match ($media->media_type) {
            CourseMedia::TYPE_THUMBNAIL => $course->update(['thumbnail_path' => null]),
            CourseMedia::TYPE_PROMO_VIDEO => $course->update(['promo_video_path' => null]),
            CourseMedia::TYPE_LESSON_VIDEO => $lesson?->update(['video_path' => null]),
            CourseMedia::TYPE_LESSON_PDF   => $lesson?->update(['pdf_path' => null]),
            default => null,
        };
    }
}
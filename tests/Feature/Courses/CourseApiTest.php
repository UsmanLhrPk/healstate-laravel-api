<?php

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use App\Models\CourseModule;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

function createCourseCategory(): array
{
    $category = ServiceCategory::create([
        'name' => 'Courses Category',
        'slug' => 'courses-category',
        'description' => 'Course category',
        'display_order' => 1,
        'is_active' => true,
    ]);

    $subcategory = ServiceSubcategory::create([
        'category_id' => $category->id,
        'name' => 'Course Subcategory',
        'slug' => 'course-subcategory',
        'description' => 'Course subcategory',
        'display_order' => 1,
        'is_active' => true,
    ]);

    return [$category, $subcategory];
}

function createPublishedCourseGraph(User $author): array
{
    [$category, $subcategory] = createCourseCategory();

    $course = Course::create([
        'user_id' => $author->id,
        'title' => 'Breathwork Foundations',
        'slug' => 'breathwork-foundations',
        'subtitle' => 'Calm nervous system basics',
        'category_id' => $category->id,
        'description' => 'A practical breathwork course.',
        'difficulty_level' => 'beginner',
        'language' => 'en',
        'pricing_type' => 'free',
        'status' => Course::STATUS_PUBLISHED,
        'published_at' => now(),
    ]);

    $course->subcategories()->attach($subcategory->id);

    $module = CourseModule::create([
        'course_id' => $course->id,
        'title' => 'Week 1',
        'description' => 'Getting started',
        'display_order' => 0,
    ]);

    $previewLesson = CourseLesson::create([
        'section_id' => $module->id,
        'course_id' => $course->id,
        'title' => 'Welcome',
        'lesson_type' => 'text',
        'text_content' => 'Public preview content',
        'duration_minutes' => 5,
        'is_preview' => true,
        'display_order' => 0,
    ]);

    $lockedLesson = CourseLesson::create([
        'section_id' => $module->id,
        'course_id' => $course->id,
        'title' => 'Core Practice',
        'lesson_type' => 'text',
        'text_content' => 'Private enrolled content',
        'duration_minutes' => 15,
        'is_preview' => false,
        'display_order' => 1,
    ]);

    $course->update(['total_duration_minutes' => 20]);

    return [$course, $module, $previewLesson, $lockedLesson];
}

it('allows an authenticated user to create a course with modules and lessons', function () {
    $user = User::factory()->create();
    [$category, $subcategory] = createCourseCategory();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/courses', [
        'title' => 'Healing Through Sound',
        'subtitle' => 'Intro to sound healing',
        'category_id' => $category->id,
        'description' => 'A complete beginner sound healing course.',
        'difficulty_level' => 'beginner',
        'language' => 'en',
        'pricing_type' => 'free',
        'status' => 'published',
        'subcategory_ids' => [$subcategory->id],
        'outcomes' => ['Understand the basics', 'Build a daily practice'],
        'requirements' => ['Quiet room', 'Notebook'],
        'modules' => [
            [
                'title' => 'Introduction',
                'description' => 'Foundations',
                'lessons' => [
                    [
                        'title' => 'What is sound healing?',
                        'lesson_type' => 'text',
                        'text_content' => 'Lesson body',
                        'duration_minutes' => 10,
                        'is_preview' => true,
                    ],
                ],
            ],
        ],
    ]);

    $response
        ->assertCreated()
        ->assertJsonPath('data.title', 'Healing Through Sound')
        ->assertJsonPath('data.status', 'published')
        ->assertJsonPath('data.modules.0.lessons.0.title', 'What is sound healing?')
        ->assertJsonPath('data.outcomes.0.text', 'Understand the basics');

    $this->assertDatabaseHas('courses', [
        'title' => 'Healing Through Sound',
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $this->assertDatabaseHas('course_sections', [
        'course_id' => Course::where('title', 'Healing Through Sound')->first()->id,
        'title' => 'Introduction',
    ]);
});

it('hides locked lesson content from public course responses', function () {
    $author = User::factory()->create();
    [$course] = createPublishedCourseGraph($author);

    $response = $this->getJson("/api/courses/{$course->slug}");

    $response->assertOk();

    $lessons = $response->json('data.modules.0.lessons');

    expect($lessons[0]['can_access'])->toBeTrue();
    expect($lessons[0]['text_content'])->toBe('Public preview content');
    expect($lessons[1]['can_access'])->toBeFalse();
    expect($lessons[1]['is_locked'])->toBeTrue();
    expect($lessons[1]['text_content'])->toBeNull();
});

it('lets an enrolled learner fetch locked lessons and update progress to completion', function () {
    $author = User::factory()->create();
    $learner = User::factory()->create();
    [$course, $module, $previewLesson, $lockedLesson] = createPublishedCourseGraph($author);

    Sanctum::actingAs($learner);

    $this->postJson("/api/courses/{$course->slug}/enroll")
        ->assertCreated()
        ->assertJsonPath('data.course.slug', $course->slug);

    $lessonResponse = $this->getJson("/api/courses/{$course->slug}/lessons/{$lockedLesson->id}");

    $lessonResponse
        ->assertOk()
        ->assertJsonPath('data.can_access', true)
        ->assertJsonPath('data.text_content', 'Private enrolled content');

    $firstProgress = $this->patchJson("/api/courses/{$course->slug}/lessons/{$previewLesson->id}/progress", [
        'is_completed' => true,
    ]);

    $firstProgress
        ->assertOk()
        ->assertJsonPath('data.is_completed', false)
        ->assertJsonPath('data.progress_percent', 50);

    $secondProgress = $this->patchJson("/api/courses/{$course->slug}/lessons/{$lockedLesson->id}/progress", [
        'is_completed' => true,
    ]);

    $secondProgress
        ->assertOk()
        ->assertJsonPath('data.is_completed', true)
        ->assertJsonPath('data.progress_percent', 100);

    $enrollment = CourseEnrollment::where('course_id', $course->id)
        ->where('user_id', $learner->id)
        ->first();

    expect($enrollment)->not->toBeNull();
    expect((float) $enrollment->progress_percent)->toBe(100.0);
    expect($enrollment->is_completed)->toBeTrue();

    $this->assertDatabaseHas('lesson_progress', [
        'enrollment_id' => $enrollment->id,
        'lesson_id' => $lockedLesson->id,
        'is_completed' => 1,
    ]);
});

it('blocks lesson progress updates for users who are not enrolled', function () {
    $author = User::factory()->create();
    $learner = User::factory()->create();
    [$course, $module, $previewLesson, $lockedLesson] = createPublishedCourseGraph($author);

    Sanctum::actingAs($learner);

    $this->patchJson("/api/courses/{$course->slug}/lessons/{$lockedLesson->id}/progress", [
        'is_completed' => true,
    ])
        ->assertStatus(422)
        ->assertJsonPath('message', 'You must enroll in this course before updating lesson progress.');
});

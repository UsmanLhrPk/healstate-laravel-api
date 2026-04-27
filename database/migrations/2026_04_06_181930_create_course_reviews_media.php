<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->constrained('course_enrollments')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('review_text')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->unique(['course_id', 'user_id'], 'unique_course_user');
            $table->index('course_id', 'idx_course');
            $table->index('user_id', 'idx_user');
            $table->index('is_visible', 'idx_visible');
        });

        Schema::create('course_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('lesson_id')->nullable()->constrained('course_lessons')->cascadeOnDelete();
            $table->foreignId('uploader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('media_type', ['thumbnail', 'promo_video', 'lesson_video', 'lesson_pdf', 'attachment']);
            $table->string('file_name', 255);
            $table->string('file_path', 500);
            $table->unsignedInteger('file_size');
            $table->string('mime_type', 100);
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();

            $table->index('course_id', 'idx_course');
            $table->index('lesson_id', 'idx_lesson');
            $table->index('media_type', 'idx_media_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_media');
        Schema::dropIfExists('course_reviews');
    }
};

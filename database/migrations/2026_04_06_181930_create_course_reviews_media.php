<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_reviews', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('enrollment_id');
            $table->unsignedTinyInteger('rating');
            $table->text('review_text')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->unique(['course_id', 'user_id'], 'unique_course_user');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('enrollment_id')->references('id')->on('course_enrollments')->onDelete('cascade');
            $table->index('course_id', 'idx_course');
            $table->index('user_id', 'idx_user');
            $table->index('is_visible', 'idx_visible');
        });

        Schema::create('course_media', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('lesson_id')->nullable();
            $table->unsignedInteger('uploader_id')->nullable();
            $table->enum('media_type', ['thumbnail', 'promo_video', 'lesson_video', 'lesson_pdf', 'attachment']);
            $table->string('file_name', 255);
            $table->string('file_path', 500);
            $table->unsignedInteger('file_size');
            $table->string('mime_type', 100);
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('course_lessons')->onDelete('cascade');
            $table->foreign('uploader_id')->references('id')->on('users')->onDelete('set null');
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
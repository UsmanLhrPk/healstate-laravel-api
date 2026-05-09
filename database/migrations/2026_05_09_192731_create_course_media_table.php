<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('lesson_id')->nullable()->constrained('course_lessons')->cascadeOnDelete();
            $table->foreignId('uploader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('media_type', [
                'thumbnail',
                'promo_video',
                'lesson_video',
                'lesson_pdf',
                'attachment',
            ]);
            $table->string('file_name', 255);       // original filename
            $table->string('file_path', 500);       // storage path
            $table->unsignedInteger('file_size');   // bytes
            $table->string('mime_type', 100);
            $table->unsignedInteger('duration_seconds')->nullable(); // video only
            $table->timestamp('uploaded_at')->useCurrent();

            $table->index('course_id');
            $table->index('lesson_id');
            $table->index('media_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_media');
    }
};
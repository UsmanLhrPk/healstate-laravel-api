<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_sections', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('course_id');
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->index('course_id', 'idx_course');
            $table->index('display_order', 'idx_order');
        });

        Schema::create('course_lessons', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('course_id');
            $table->string('title', 150);
            $table->enum('lesson_type', ['video', 'text', 'pdf']);
            $table->string('video_path', 500)->nullable();
            $table->string('video_url', 500)->nullable();
            $table->longText('text_content')->nullable();
            $table->string('pdf_path', 500)->nullable();
            $table->unsignedInteger('duration_minutes')->default(0);
            $table->boolean('is_preview')->default(false);
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('course_sections')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->index('section_id', 'idx_section');
            $table->index('course_id', 'idx_course');
            $table->index('display_order', 'idx_order');
            $table->index('is_preview', 'idx_preview');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
        Schema::dropIfExists('course_sections');
    }
};  
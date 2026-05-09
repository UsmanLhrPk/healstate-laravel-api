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
            $table->tinyInteger('rating')->unsigned()->comment('1–5');
            $table->text('review_text')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->unsignedTinyInteger('deletion_count')->default(0); // enforce resubmit-once
            $table->timestamps();

            $table->unique(['course_id', 'user_id']);
            $table->index('course_id');
            $table->index('user_id');
            $table->index('is_visible');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_reviews');
    }
};
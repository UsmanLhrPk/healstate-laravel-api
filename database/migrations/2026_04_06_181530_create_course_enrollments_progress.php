<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('enrollment_type', ['free', 'paid']);
            $table->decimal('amount_paid', 8, 2)->nullable();
            $table->string('payment_reference', 255)->nullable();
            $table->decimal('progress_percent', 5, 2)->default(0.00);
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('last_accessed_at')->nullable();
            $table->timestamp('enrolled_at')->useCurrent();

            $table->unique(['course_id', 'user_id'], 'unique_course_user');
            $table->index('course_id', 'idx_course');
            $table->index('user_id', 'idx_user');
            $table->index('is_completed', 'idx_completed');
        });

        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained('course_enrollments')->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained('course_lessons')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->decimal('watch_percent', 5, 2)->nullable();
            $table->timestamps();

            $table->unique(['enrollment_id', 'lesson_id'], 'unique_enrollment_lesson');
            $table->index(['user_id', 'course_id'], 'idx_user_course');
            $table->index('lesson_id', 'idx_lesson');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_progress');
        Schema::dropIfExists('course_enrollments');
    }
};

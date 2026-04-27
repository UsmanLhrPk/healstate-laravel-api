<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('outcome_text', 200);
            $table->integer('display_order')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->index('course_id', 'idx_course');
        });

        Schema::create('course_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('requirement_text', 200);
            $table->integer('display_order')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->index('course_id', 'idx_course');
        });

        Schema::create('course_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained('service_subcategories')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['course_id', 'subcategory_id'], 'unique_course_subcategory');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_subcategories');
        Schema::dropIfExists('course_requirements');
        Schema::dropIfExists('course_outcomes');
    }
};

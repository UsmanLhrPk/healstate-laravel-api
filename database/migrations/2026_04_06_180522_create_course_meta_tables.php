<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_outcomes', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('course_id');
            $table->string('outcome_text', 200);
            $table->integer('display_order')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->index('course_id', 'idx_course');
        });

        Schema::create('course_requirements', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('course_id');
            $table->string('requirement_text', 200);
            $table->integer('display_order')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->index('course_id', 'idx_course');
        });

        Schema::create('course_subcategories', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('subcategory_id');
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['course_id', 'subcategory_id'], 'unique_course_subcategory');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('service_subcategories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_subcategories');
        Schema::dropIfExists('course_requirements');
        Schema::dropIfExists('course_outcomes');
    }
};
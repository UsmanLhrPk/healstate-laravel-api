<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('title', 150);
            $table->string('slug', 170)->unique();
            $table->string('subtitle', 250)->nullable();
            $table->unsignedInteger('category_id');
            $table->text('description');
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced', 'all_levels']);
            $table->string('language', 10)->default('en');
            $table->string('thumbnail_path', 500)->nullable();
            $table->string('promo_video_path', 500)->nullable();
            $table->string('promo_video_url', 500)->nullable();
            $table->enum('pricing_type', ['free', 'paid'])->default('free');
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->enum('status', ['draft', 'pending', 'published', 'rejected', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('total_enrollments')->default(0);
            $table->decimal('average_rating', 3, 2)->nullable();
            $table->unsignedInteger('total_reviews')->default(0);
            $table->unsignedInteger('total_duration_minutes')->default(0);
            $table->unsignedInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('restrict');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');

            $table->index('user_id', 'idx_user');
            $table->index('category_id', 'idx_category');
            $table->index('status', 'idx_status');
            $table->index('is_featured', 'idx_featured');
            $table->index('average_rating', 'idx_rating');
            $table->index(['status', 'category_id'], 'idx_status_category');
            $table->index(['status', 'is_featured'], 'idx_status_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

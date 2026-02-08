<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('service_categories')->onDelete('cascade');
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('category_id', 'idx_category');
            $table->index('slug', 'idx_slug');
            $table->index('is_active', 'idx_active');
            $table->unique(['category_id', 'slug'], 'unique_category_slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_subcategories');
    }
};
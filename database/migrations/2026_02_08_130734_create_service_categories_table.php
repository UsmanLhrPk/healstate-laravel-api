<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('slug', 'idx_slug');
            $table->index('is_active', 'idx_active');
            $table->index('display_order', 'idx_display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('viewable_type'); // Polymorphic: 'App\Models\Forum', 'App\Models\Comment', etc.
            $table->unsignedBigInteger('viewable_id');
            $table->timestamp('created_at');
            
            // Index for faster queries
            $table->index(['viewable_type', 'viewable_id']);
            
            // Ensure one view per user per item (prevents duplicates)
            $table->unique(['user_id', 'viewable_type', 'viewable_id'], 'views_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
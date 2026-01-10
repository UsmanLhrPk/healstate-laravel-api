<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('flaggable_type');
            $table->unsignedBigInteger('flaggable_id');
            $table->timestamp('created_at')->useCurrent();

            // Unique constraint to prevent duplicate flags
            $table->unique(['user_id', 'flaggable_type', 'flaggable_id'], 'user_flaggable_unique');

            // Indexes for polymorphic relationship
            $table->index(['flaggable_type', 'flaggable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flags');
    }
};
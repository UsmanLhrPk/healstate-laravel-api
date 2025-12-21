<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('title', 400);
            $table->text('content');
            $table->enum('category', [
                'Mind',
                'Body',
                'Spirit',
                'Biohacking',
                'Frequency Healing',
                'Holistic Health'
            ]);
            $table->string('sub_category');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['approved', 'flagged', 'disapproved'])->default('approved');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index('category');
            $table->index('author_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
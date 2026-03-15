<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamps();

            // One review per user per practitioner
            $table->unique(['practitioner_profile_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_reviews');
    }
};
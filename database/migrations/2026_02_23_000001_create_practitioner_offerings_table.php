<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_offerings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_profile_id')->constrained('practitioner_profiles')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained('service_subcategories')->restrictOnDelete();
            $table->string('title');
            $table->string('brief', 255);
            $table->text('description');
            $table->integer('duration'); // in minutes
            $table->decimal('price', 10, 2);
            $table->boolean('active')->default(true);
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_offerings');
    }
};

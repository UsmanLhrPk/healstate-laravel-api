<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_offering_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_offering_id')->constrained('practitioner_offerings')->cascadeOnDelete();
            $table->integer('duration'); // minutes
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_offering_slots');
    }
};

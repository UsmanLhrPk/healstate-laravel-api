<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_slot_id')
                  ->constrained('service_slots')
                  ->onDelete('cascade');
            $table->tinyInteger('day_of_week'); // 0=Sunday, 1=Monday, ..., 6=Saturday
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            
            $table->index(['service_slot_id', 'day_of_week']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_availability');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_offering_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_offering_slot_id')
                ->constrained('practitioner_offering_slots', 'id', 'poa_slot_id_foreign')
                ->cascadeOnDelete();
            $table->tinyInteger('day_of_week'); // 0=Sunday, 6=Saturday
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_offering_availability');
    }
};

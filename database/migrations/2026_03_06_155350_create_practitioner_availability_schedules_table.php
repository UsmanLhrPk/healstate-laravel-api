<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop and recreate cleanly if it exists from a partial previous run
        Schema::dropIfExists('practitioner_availability_schedules');

        Schema::create('practitioner_availability_schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('practitioner_profile_id');
            $table->foreign('practitioner_profile_id', 'pas_profile_id_foreign')
                  ->references('id')->on('practitioner_profiles')
                  ->onDelete('cascade');

            $table->date('week_start_date');
            $table->date('week_end_date');
            $table->json('weekly_pattern');
            $table->boolean('is_active')->default(true);
            $table->json('skipped_dates')->nullable();
            $table->enum('source', ['application', 'repeat'])->default('application');

            $table->timestamps();

            $table->index('week_start_date',                              'pas_week_start_index');
            $table->index('week_end_date',                                'pas_week_end_index');
            $table->index(['practitioner_profile_id', 'week_start_date'], 'pas_profile_week_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_availability_schedules');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove duplicate bookings, keeping only the earliest one per slot+date+time
        DB::statement('
        DELETE FROM practitioner_offering_bookings
        WHERE id NOT IN (
            SELECT min_id FROM (
                SELECT MIN(id) as min_id
                FROM practitioner_offering_bookings
                GROUP BY practitioner_offering_slot_id, booking_date, start_time
            ) as keepers
        )
    ');

        Schema::table('practitioner_offering_bookings', function (Blueprint $table) {
            $table->unique(
                ['practitioner_offering_slot_id', 'booking_date', 'start_time'],
                'unique_active_slot_booking'
            );
        });
    }

    public function down(): void
    {
        Schema::table('practitioner_offering_bookings', function (Blueprint $table) {
            $table->dropUnique('unique_active_slot_booking');
        });
    }
};

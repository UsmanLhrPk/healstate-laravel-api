<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if the foreign key already exists before adding it
        $foreignKeys = collect(DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = 'practitioner_offering_bookings'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        "))->pluck('CONSTRAINT_NAME')->toArray();

        if (!in_array('pob_slot_id_foreign', $foreignKeys)) {
            DB::statement('ALTER TABLE practitioner_offering_bookings ADD CONSTRAINT pob_slot_id_foreign FOREIGN KEY (practitioner_offering_slot_id) REFERENCES practitioner_offering_slots(id) ON DELETE CASCADE');
        }
    }

    public function down(): void
    {
        $foreignKeys = collect(DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = 'practitioner_offering_bookings'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        "))->pluck('CONSTRAINT_NAME')->toArray();

        if (in_array('pob_slot_id_foreign', $foreignKeys)) {
            DB::statement('ALTER TABLE practitioner_offering_bookings DROP FOREIGN KEY pob_slot_id_foreign');
        }

        DB::statement('DROP INDEX IF EXISTS practitioner_booking_lookup_index ON practitioner_offering_bookings');
        DB::statement('ALTER TABLE practitioner_offering_bookings ADD UNIQUE KEY unique_active_slot_booking (practitioner_offering_slot_id, booking_date, start_time)');

        if (in_array('pob_slot_id_foreign', $foreignKeys)) {
            DB::statement('ALTER TABLE practitioner_offering_bookings ADD CONSTRAINT pob_slot_id_foreign FOREIGN KEY (practitioner_offering_slot_id) REFERENCES practitioner_offering_slots(id) ON DELETE CASCADE');
        }
    }
};
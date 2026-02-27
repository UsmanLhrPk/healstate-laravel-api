<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE practitioner_offering_bookings ADD CONSTRAINT pob_slot_id_foreign FOREIGN KEY (practitioner_offering_slot_id) REFERENCES practitioner_offering_slots(id) ON DELETE CASCADE');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE practitioner_offering_bookings DROP FOREIGN KEY pob_slot_id_foreign');
        DB::statement('DROP INDEX practitioner_booking_lookup_index ON practitioner_offering_bookings');
        DB::statement('ALTER TABLE practitioner_offering_bookings ADD UNIQUE KEY unique_active_slot_booking (practitioner_offering_slot_id, booking_date, start_time)');
        DB::statement('ALTER TABLE practitioner_offering_bookings ADD CONSTRAINT pob_slot_id_foreign FOREIGN KEY (practitioner_offering_slot_id) REFERENCES practitioner_offering_slots(id) ON DELETE CASCADE');
    }
};

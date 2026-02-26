<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Add practitioner offering slot reference (after service_booking_id)
            $table->foreignId('practitioner_offering_slot_id')
                ->nullable()
                ->after('service_booking_id')
                ->constrained('practitioner_offering_slots')
                ->nullOnDelete();

            // Add practitioner offering booking reference
            $table->foreignId('practitioner_offering_booking_id')
                ->nullable()
                ->after('practitioner_offering_slot_id')
                ->constrained('practitioner_offering_bookings')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['practitioner_offering_slot_id']);
            $table->dropForeign(['practitioner_offering_booking_id']);
            $table->dropColumn([
                'practitioner_offering_slot_id',
                'practitioner_offering_booking_id',
            ]);
        });
    }
};
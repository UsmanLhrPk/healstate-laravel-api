<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // New healer slot column — sits alongside the legacy service_slot_id
            // which we leave intact so existing vendor-service cart rows keep working
            $table->foreignId('practitioner_offering_slot_id')
                ->nullable()
                ->after('service_slot_id')
                ->constrained('practitioner_offering_slots')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['practitioner_offering_slot_id']);
            $table->dropColumn('practitioner_offering_slot_id');
        });
    }
};
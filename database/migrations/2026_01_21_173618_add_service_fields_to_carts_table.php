<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('service_slot_id')->nullable()->constrained('service_slots')->onDelete('cascade');
            $table->date('booking_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['service_slot_id']);
            $table->dropColumn(['service_slot_id', 'booking_date', 'start_time', 'end_time']);
        });
    }
};

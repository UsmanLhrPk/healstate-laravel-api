<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Add service fields
            $table->foreignId('service_slot_id')->nullable()->after('variant_id');
            $table->foreignId('service_booking_id')->nullable()->after('service_slot_id');
            $table->string('type')->default('product')->after('product_name'); // 'product' or 'service'
            $table->date('booking_date')->nullable()->after('type');
            $table->time('start_time')->nullable()->after('booking_date');
            $table->time('end_time')->nullable()->after('start_time');
            
            // Make existing fields nullable for services
            $table->foreignId('product_id')->nullable()->change();
            $table->foreignId('variant_id')->nullable()->change();
            
            // Add foreign key constraints for service fields
            $table->foreign('service_slot_id')->references('id')->on('service_slots')->onDelete('cascade');
            $table->foreign('service_booking_id')->references('id')->on('service_bookings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Remove foreign keys first
            $table->dropForeign(['service_slot_id']);
            $table->dropForeign(['service_booking_id']);
            
            // Remove service fields
            $table->dropColumn([
                'service_slot_id',
                'service_booking_id',
                'type',
                'booking_date',
                'start_time',
                'end_time'
            ]);
            
            // Revert product fields to not nullable if needed
            $table->foreignId('product_id')->nullable(false)->change();
            $table->foreignId('variant_id')->nullable()->change();
        });
    }
};
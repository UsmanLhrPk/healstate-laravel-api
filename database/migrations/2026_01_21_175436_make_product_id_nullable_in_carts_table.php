<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Make product_id nullable
            $table->foreignId('product_id')->nullable()->change();
            
            // Make variant_id nullable (if not already)
            $table->foreignId('variant_id')->nullable()->change();
            
            // Make sure service fields exist and are nullable
            if (!Schema::hasColumn('carts', 'service_slot_id')) {
                $table->foreignId('service_slot_id')->nullable()->after('variant_id');
                $table->foreign('service_slot_id')->references('id')->on('service_slots')->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('carts', 'booking_date')) {
                $table->date('booking_date')->nullable()->after('service_slot_id');
            }
            
            if (!Schema::hasColumn('carts', 'start_time')) {
                $table->time('start_time')->nullable()->after('booking_date');
            }
            
            if (!Schema::hasColumn('carts', 'end_time')) {
                $table->time('end_time')->nullable()->after('start_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // You can revert if needed, but be careful
            $table->foreignId('product_id')->nullable(false)->change();
            $table->foreignId('variant_id')->nullable(false)->change();
        });
    }
};
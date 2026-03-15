<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add per-item refund tracking to order_items.
 *
 * When a healer skips a day, we refund only the booking's line-item subtotal
 * (not the full order total, since the order may contain other items).
 * These columns mirror what OrderService already stores on the orders table,
 * but at the item level.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('refund_id')->nullable()->after('subtotal');
            $table->string('refund_status')->nullable()->after('refund_id');
            $table->decimal('refund_amount', 10, 2)->nullable()->after('refund_status');
            $table->timestamp('refunded_at')->nullable()->after('refund_amount');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['refund_id', 'refund_status', 'refund_amount', 'refunded_at']);
        });
    }
};
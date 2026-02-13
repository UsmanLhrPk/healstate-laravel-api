<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('cancellation_requested_at')->nullable()->after('paid_at');
            $table->text('cancellation_reason')->nullable()->after('cancellation_requested_at');
            $table->string('cancelled_by')->nullable()->after('cancellation_reason'); // 'user' or 'vendor'
            $table->string('cancellation_type')->nullable()->after('cancelled_by'); // 'immediate' or 'requested'
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'cancellation_requested_at',
                'cancellation_reason',
                'cancelled_by',
                'cancellation_type',
            ]);
        });
    }
};
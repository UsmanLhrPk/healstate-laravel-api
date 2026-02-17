<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('verified_at');
            $table->text('rejection_reason')->nullable()->after('status');
        $table->text('admin_notes')->nullable()->after('rejection_reason');
            $table->foreignId('reviewed_by')->nullable()->constrained('admins')->after('admin_notes');
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
        });
    }

    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['status', 'rejection_reason', 'admin_notes', 'reviewed_by', 'reviewed_at']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_practitioner')->default(false)->after('email_verified_at');
            $table->index('is_practitioner', 'idx_is_practitioner');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_is_practitioner');
            $table->dropColumn('is_practitioner');
        });
    }
};
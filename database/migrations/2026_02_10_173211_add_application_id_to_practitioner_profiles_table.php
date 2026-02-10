<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('practitioner_profiles', function (Blueprint $table) {
            $table->foreignId('application_id')->nullable()->after('user_id')->constrained('practitioner_applications')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('practitioner_profiles', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
            $table->dropColumn('application_id');
        });
    }
};
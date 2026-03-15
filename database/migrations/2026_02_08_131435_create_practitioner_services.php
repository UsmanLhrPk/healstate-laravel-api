<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_profile_id')->constrained('practitioner_profiles')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('service_subcategories')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('practitioner_profile_id', 'idx_practitioner');
            $table->index('subcategory_id', 'idx_subcategory');
            $table->unique(['practitioner_profile_id', 'subcategory_id'], 'unique_practitioner_service');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_services');
    }
};
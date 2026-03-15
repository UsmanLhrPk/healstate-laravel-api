<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('practitioner_applications')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('service_subcategories')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('application_id', 'idx_application');
            $table->index('subcategory_id', 'idx_subcategory');
            $table->unique(['application_id', 'subcategory_id'], 'unique_application_service');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_services');
    }
};
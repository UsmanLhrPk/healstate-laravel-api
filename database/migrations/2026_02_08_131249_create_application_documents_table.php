<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('practitioner_applications')->onDelete('cascade');
            $table->string('file_name', 255);
            $table->string('file_path', 500);
            $table->string('file_type', 50);
            $table->unsignedInteger('file_size'); // in bytes, max 5MB
            $table->enum('document_type', ['certification', 'license', 'credential', 'other'])->default('credential');
            $table->timestamp('uploaded_at')->useCurrent();
            
            $table->index('application_id', 'idx_application');
            $table->index('document_type', 'idx_document_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_documents');
    }
};
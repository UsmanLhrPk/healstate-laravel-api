<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_applications', function (Blueprint $table) {
            $table->id();

            // Foreign keys - use foreignId() which creates the column AND constraint
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Personal / Professional Information
            $table->string('phone_number', 20);
            $table->string('professional_title', 255);
            $table->enum('years_experience', [
                '0-1', '1-3', '3-5', '5-10',
                '10+', '15+', '20+', '25+', '30+'
            ]);
            $table->text('bio');

            // Credentials
            $table->string('license_number', 100)->nullable();
            $table->string('issuing_organization', 255)->nullable();

            // Service Information
            $table->foreignId('primary_category_id')
                ->constrained('service_categories')
                ->onDelete('restrict');

            $table->text('service_description');

            // Availability
            $table->json('availability_schedule')->nullable();
            $table->string('timezone', 50)->default('UTC');

            // Application Status
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->timestamp('reviewed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->text('admin_notes')->nullable();

            // Generated column - CHANGED to virtualAs
            $table->unsignedBigInteger('pending_user_id')
                ->nullable()
                ->virtualAs('IF(status = "pending", user_id, NULL)');

            $table->unique('pending_user_id', 'unique_user_pending');

            // Terms Agreement
            $table->boolean('terms_agreed')->default(false);
            $table->timestamp('terms_agreed_at')->nullable();

            // Timestamps
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();

            // Indexes (only non-FK columns)
            $table->index('status', 'idx_status');
            $table->index('submitted_at', 'idx_submitted');
            $table->index(['status', 'submitted_at'], 'idx_status_submitted');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_applications');
    }
};
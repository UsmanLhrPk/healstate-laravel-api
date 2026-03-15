<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('email_to', 255);
            $table->string('email_subject', 255);
            $table->enum('email_type', [
                'application_received',
                'application_approved',
                'application_rejected',
                'new_application_admin'
            ]);
            $table->foreignId('related_application_id')->nullable()->constrained('practitioner_applications')->onDelete('set null');
            $table->timestamp('sent_at')->useCurrent();
            $table->enum('delivery_status', ['sent', 'failed', 'bounced'])->default('sent');
            $table->text('error_message')->nullable();
            
            $table->index('user_id', 'idx_user');
            $table->index('email_type', 'idx_email_type');
            $table->index('related_application_id', 'idx_application');
            $table->index('sent_at', 'idx_sent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_notifications');
    }
};
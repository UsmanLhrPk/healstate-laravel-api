<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('practitioner_profiles', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('application_id');
            $table->string('professional_title')->nullable()->after('phone_number');
            $table->string('years_experience')->nullable()->after('professional_title');
            $table->text('bio')->nullable()->after('years_experience');
            $table->string('license_number')->nullable()->after('bio');
            $table->string('issuing_organization')->nullable()->after('license_number');
            $table->unsignedBigInteger('primary_category_id')->nullable()->after('issuing_organization');
            $table->text('service_description')->nullable()->after('primary_category_id');
            $table->json('availability_schedule')->nullable()->after('service_description');
            $table->string('timezone')->default('UTC')->after('availability_schedule');
            $table->boolean('is_active')->default(true)->after('timezone');
            $table->boolean('is_accepting_clients')->default(true)->after('is_active');
            $table->string('profile_image_path')->nullable()->after('is_accepting_clients');
            $table->integer('total_bookings')->default(0)->after('profile_image_path');
            $table->decimal('average_rating', 3, 2)->nullable()->after('total_bookings');
            $table->integer('total_reviews')->default(0)->after('average_rating');

            $table->foreign('primary_category_id')
                  ->references('id')
                  ->on('service_categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('practitioner_profiles', function (Blueprint $table) {
            $table->dropForeign(['primary_category_id']);
            $table->dropColumn([
                'phone_number', 'professional_title', 'years_experience', 'bio',
                'license_number', 'issuing_organization', 'primary_category_id',
                'service_description', 'availability_schedule', 'timezone',
                'is_active', 'is_accepting_clients', 'profile_image_path',
                'total_bookings', 'average_rating', 'total_reviews',
            ]);
        });
    }
};
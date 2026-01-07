<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            // Drop the existing global unique constraint on sort
            $table->dropUnique('product_variants_sort_unique');
            
            // Add a composite unique constraint (product_id + sort)
            // This allows different products to have the same sort values
            $table->unique(['product_id', 'sort'], 'product_variants_product_sort_unique');
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->dropUnique('product_variants_product_sort_unique');
            $table->unique('sort', 'product_variants_sort_unique');
        });
    }
};
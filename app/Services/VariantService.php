<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class VariantService
{
    public function createVariant(Product $product, array $data): ProductVariant
    {
        return DB::transaction(function () use ($product, $data) {
            $maxSort = ProductVariant::max('sort') ?? 0;
            $data['product_id'] = $product->id;
            $data['sort'] = $maxSort + 1;
            
            return ProductVariant::create($data);
        });
    }

    public function updateVariant(ProductVariant $variant, array $data): ProductVariant
    {
        DB::transaction(function () use ($variant, $data) {
            // Only update fillable fields
            $fillableData = array_intersect_key($data, array_flip($variant->getFillable()));
            $variant->update($fillableData);
        });

        return $variant->fresh();
    }

    public function deleteVariant(ProductVariant $variant): bool
    {
        return DB::transaction(function () use ($variant) {
            return $variant->delete();
        });
    }
}
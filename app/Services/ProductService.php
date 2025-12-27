<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(Vendor $vendor, array $data): Product
    {
        return DB::transaction(function () use ($vendor, $data) {
            $data['vendor_id'] = $vendor->id;
            return Product::create($data);
        });
    }

    public function updateProduct(Product $product, array $data): Product
    {
        DB::transaction(function () use ($product, $data) {
            $product->update($data);
        });

        return $product->fresh();
    }

    public function deleteProduct(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            return $product->delete();
        });
    }

    public function getProductWithDetails(int $productId): ?Product
    {
        return Product::with(['vendor', 'variants', 'serviceSlots'])
            ->find($productId);
    }

    public function getVendorProducts(int $vendorId, int $perPage = 15): LengthAwarePaginator
    {
        return Product::where('vendor_id', $vendorId)
            ->with(['variants', 'serviceSlots'])
            ->latest()
            ->paginate($perPage);
    }

    public function getAllProducts(int $perPage = 15): LengthAwarePaginator
    {
        return Product::with(['vendor', 'variants', 'serviceSlots'])
            ->where('active', true)
            ->latest()
            ->paginate($perPage);
    }
}
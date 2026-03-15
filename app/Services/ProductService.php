<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct(Vendor $vendor, array $data): Product
    {
        return DB::transaction(function () use ($vendor, $data) {
            $imagePaths = [];
            if (isset($data['images']) && is_array($data['images'])) {
                foreach ($data['images'] as $image) {
                    if ($image instanceof \Illuminate\Http\UploadedFile) {
                        $path = $image->store('products', 'public');
                        $imagePaths[] = Storage::url($path);
                    }
                }
            }

            $product = Product::create([
                'vendor_id'   => $vendor->id,
                'title'       => $data['title'],
                'brief'       => $data['brief'],
                'description' => $data['description'],
                'active'      => $data['active'] ?? true,
                'images'      => $imagePaths,
            ]);

            if (isset($data['variants'])) {
                $variants = array_values($data['variants']);
                foreach ($variants as $index => $variantData) {
                    $product->variants()->create([
                        'name'  => $variantData['name'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'] ?? 0,
                        'sort'  => $index,
                    ]);
                }
            }

            return $product->load('variants');
        });
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            if (isset($data['images']) && is_array($data['images'])) {
                $newImagePaths = [];

                foreach ($data['images'] as $image) {
                    if ($image instanceof \Illuminate\Http\UploadedFile) {
                        $path = $image->store('products', 'public');
                        $newImagePaths[] = Storage::url($path);
                    }
                }

                if (! empty($newImagePaths) && $product->images) {
                    foreach ($product->images as $oldImageUrl) {
                        $oldPath = str_replace('/storage/', '', parse_url($oldImageUrl, PHP_URL_PATH));
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $data['images'] = $newImagePaths;
            }

            $fillableData = array_intersect_key($data, array_flip($product->getFillable()));
            $product->update($fillableData);

            if (isset($data['variants'])) {
                $variants   = array_values($data['variants']);
                $variantIds = collect($variants)->pluck('id')->filter()->toArray();

                foreach ($variants as $index => $variantData) {
                    if (isset($variantData['id'])) {
                        $product->variants()->where('id', $variantData['id'])->update([
                            'name'  => $variantData['name'],
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'] ?? 0,
                            'sort'  => $index,
                        ]);
                    }
                }

                $product->variants()->whereNotIn('id', $variantIds)->delete();

                foreach ($variants as $index => $variantData) {
                    if (! isset($variantData['id'])) {
                        $product->variants()->create([
                            'name'  => $variantData['name'],
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'] ?? 0,
                            'sort'  => $index,
                        ]);
                    }
                }
            }

            return $product->fresh('variants');
        });
    }

    public function deleteProduct(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            if ($product->images) {
                foreach ($product->images as $imageUrl) {
                    $path = str_replace('/storage/', '', parse_url($imageUrl, PHP_URL_PATH));
                    Storage::disk('public')->delete($path);
                }
            }

            return $product->delete();
        });
    }

    public function getProductWithDetails(int $productId): ?Product
    {
        return Product::with(['vendor', 'variants'])->find($productId);
    }

    public function getVendorProducts(int $vendorId, int $perPage = 15): LengthAwarePaginator
    {
        return Product::where('vendor_id', $vendorId)
            ->with('variants')
            ->latest()
            ->paginate($perPage);
    }

    public function getAllProducts(int $perPage = 15): LengthAwarePaginator
    {
        return Product::with(['vendor', 'variants'])
            ->where('active', true)
            ->latest()
            ->paginate($perPage);
    }
}
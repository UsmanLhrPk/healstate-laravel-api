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
            // Handle image uploads
            $imagePaths = [];
            if (isset($data['images']) && is_array($data['images'])) {
                foreach ($data['images'] as $image) {
                    if ($image instanceof \Illuminate\Http\UploadedFile) {
                        $path = $image->store('products', 'public');
                        $imagePaths[] = Storage::url($path);
                    }
                }
            }

            // Create product
            $product = Product::create([
                'vendor_id' => $vendor->id,
                'title' => $data['title'],
                'brief' => $data['brief'],
                'description' => $data['description'],
                'type' => $data['type'],
                'active' => $data['active'] ?? true,
                'images' => $imagePaths,
            ]);

            // Handle variants for products
            if ($product->isProduct() && isset($data['variants'])) {
                $variants = array_values($data['variants']); // Reset keys to ensure sequential indexing
                foreach ($variants as $index => $variantData) {
                    $product->variants()->create([
                        'name' => $variantData['name'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'] ?? 0,
                        'sort' => $index,
                    ]);
                }
            }

            // Handle slots for services
            if ($product->isService() && isset($data['slots'])) {
                foreach ($data['slots'] as $slotData) {
                    $product->serviceSlots()->create([
                        'duration' => $slotData['duration'],
                        'price' => $slotData['price'],
                    ]);
                }
            }

            return $product->load(['variants', 'serviceSlots']);
        });
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            // Handle new image uploads
            if (isset($data['images']) && is_array($data['images'])) {
                $newImagePaths = [];

                foreach ($data['images'] as $image) {
                    if ($image instanceof \Illuminate\Http\UploadedFile) {
                        $path = $image->store('products', 'public');
                        $newImagePaths[] = Storage::url($path);
                    }
                }

                // Delete old images if new ones are uploaded
                if (! empty($newImagePaths) && $product->images) {
                    foreach ($product->images as $oldImageUrl) {
                        $oldPath = str_replace('/storage/', '', parse_url($oldImageUrl, PHP_URL_PATH));
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $data['images'] = $newImagePaths;
            }

            // Update basic product fields
            $fillableData = array_intersect_key($data, array_flip($product->getFillable()));
            $product->update($fillableData);

            // Update variants if provided
            if (isset($data['variants']) && $product->isProduct()) {
                // Reset array keys to ensure sequential indexing
                $variants = array_values($data['variants']);
                
                // Get IDs of variants to keep
                $variantIds = collect($variants)
                    ->pluck('id')
                    ->filter()
                    ->toArray();

                // First, update existing variants
                foreach ($variants as $index => $variantData) {
                    if (isset($variantData['id'])) {
                        $product->variants()->where('id', $variantData['id'])->update([
                            'name' => $variantData['name'],
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'] ?? 0,
                            'sort' => $index,
                        ]);
                    }
                }

                // Then, delete variants not in the update
                $product->variants()->whereNotIn('id', $variantIds)->delete();

                // Finally, create new variants
                foreach ($variants as $index => $variantData) {
                    if (! isset($variantData['id'])) {
                        $product->variants()->create([
                            'name' => $variantData['name'],
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'] ?? 0,
                            'sort' => $index,
                        ]);
                    }
                }
            }

            // Update slots if provided
            if (isset($data['slots']) && $product->isService()) {
                $slotIds = collect($data['slots'])
                    ->pluck('id')
                    ->filter()
                    ->toArray();

                $product->serviceSlots()->whereNotIn('id', $slotIds)->delete();

                foreach ($data['slots'] as $slotData) {
                    if (isset($slotData['id'])) {
                        $product->serviceSlots()->where('id', $slotData['id'])->update([
                            'duration' => $slotData['duration'],
                            'price' => $slotData['price'],
                        ]);
                    } else {
                        $product->serviceSlots()->create([
                            'duration' => $slotData['duration'],
                            'price' => $slotData['price'],
                        ]);
                    }
                }
            }

            return $product->fresh(['variants', 'serviceSlots']);
        });
    }

    public function deleteProduct(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            // Delete associated images
            if ($product->images) {
                foreach ($product->images as $imageUrl) {
                    $path = str_replace('/storage/', '', parse_url($imageUrl, PHP_URL_PATH));
                    Storage::disk('public')->delete($oldPath);
                }
            }

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
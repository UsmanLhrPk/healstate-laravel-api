<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreVariantRequest;
use App\Http\Requests\Vendors\UpdateVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\VariantService;
use Illuminate\Http\JsonResponse;

/**
 * @group Product Variants
 * 
 * APIs for managing product variants (sizes, colors, etc.)
 */
class VariantController extends Controller
{
    public function __construct(
        protected VariantService $variantService
    ) {}

    /**
     * Create Product Variant
     * 
     * Add a new variant to a product. Sort order is auto-incremented.
     * 
     * @authenticated
     * 
     * @urlParam product integer required The product ID. Example: 1
     * 
     * @bodyParam name string required Variant name. Example: Large (Blue)
     * @bodyParam price number required Variant price. Example: 29.99
     * @bodyParam stock integer optional Stock quantity. Example: 100
     * 
     * @response 201 {
     *   "message": "Variant created successfully",
     *   "data": {
     *     "id": 1,
     *     "product_id": 1,
     *     "name": "Large (Blue)",
     *     "price": "29.99",
     *     "stock": 100,
     *     "sort": 1,
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     */
    public function store(StoreVariantRequest $request, Product $product): JsonResponse
    {
        $variant = $this->variantService->createVariant(
            $product,
            $request->validated()
        );

        return response()->json([
            'message' => 'Variant created successfully',
            'data' => $variant,
        ], 201);
    }

    /**
     * Update Product Variant
     * 
     * Update variant details. Only vendor owner can update.
     * 
     * @authenticated
     * 
     * @urlParam variant integer required The variant ID. Example: 1
     * 
     * @bodyParam name string optional Variant name. Example: Medium (Red)
     * @bodyParam price number optional Variant price. Example: 24.99
     * @bodyParam stock integer optional Stock quantity. Example: 50
     * 
     * @response {
     *   "message": "Variant updated successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "Medium (Red)",
     *     "price": "24.99",
     *     "stock": 50,
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     */
    public function update(UpdateVariantRequest $request, ProductVariant $variant): JsonResponse
    {
        $variant = $this->variantService->updateVariant(
            $variant,
            $request->validated()
        );

        return response()->json([
            'message' => 'Variant updated successfully',
            'data' => $variant,
        ]);
    }

    /**
     * Delete Product Variant
     * 
     * Delete a variant. Only vendor owner can delete.
     * 
     * @authenticated
     * 
     * @urlParam variant integer required The variant ID. Example: 1
     * 
     * @response {
     *   "message": "Variant deleted successfully"
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function destroy(ProductVariant $variant): JsonResponse
    {
        $this->authorize('delete', $variant);
        
        $this->variantService->deleteVariant($variant);

        return response()->json([
            'message' => 'Variant deleted successfully',
        ]);
    }
}
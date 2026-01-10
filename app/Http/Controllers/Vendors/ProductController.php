<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreProductRequest;
use App\Http\Requests\Vendors\UpdateProductRequest;
use App\Models\Product;
use App\Models\Vendor;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Product Management
 * 
 * APIs for managing products and services
 */
class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * Create Product/Service
     * 
     * Create a new product or service for a vendor.
     * 
     * @authenticated
     * 
     * @urlParam vendor integer required The vendor ID. Example: 1
     * 
     * @bodyParam title string required Product/service title. Example: Web Development Package
     * @bodyParam brief string required Short description (max 255 chars). Example: Professional website development
     * @bodyParam description string required Detailed description (max 4000 chars). Example: We build responsive websites...
     * @bodyParam type string required Type: "product" or "service". Example: service
     * @bodyParam active boolean optional Whether product is active. Example: true
     * 
     * @response 201 {
     *   "message": "Product created successfully",
     *   "data": {
     *     "id": 1,
     *     "vendor_id": 1,
     *     "title": "Web Development Package",
     *     "brief": "Professional website development",
     *     "type": "service",
     *     "active": true,
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     */
    public function store(StoreProductRequest $request, Vendor $vendor): JsonResponse
    {
        $product = $this->productService->createProduct(
            $vendor,
            $request->validated()
        );

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    /**
     * List Vendor Products
     * 
     * Get all products/services for a specific vendor with pagination.
     * 
     * @urlParam vendor integer required The vendor ID. Example: 1
     * 
     * @queryParam page integer Page number. Example: 1
     * @queryParam per_page integer Items per page (max 100). Example: 15
     * 
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Web Development Package",
     *       "type": "service",
     *       "variants": [],
     *       "service_slots": [
     *         {
     *           "id": 1,
     *           "duration": 60,
     *           "price": "150.00"
     *         }
     *       ]
     *     }
     *   ],
     *   "links": {
     *     "first": "http://localhost/api/vendors/1/products?page=1",
     *     "last": "http://localhost/api/vendors/1/products?page=3",
     *     "prev": null,
     *     "next": "http://localhost/api/vendors/1/products?page=2"
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 3,
     *     "per_page": 15,
     *     "to": 15,
     *     "total": 45
     *   }
     * }
     */
    public function index(Request $request, Vendor $vendor): JsonResponse
    {
        $perPage = min($request->input('per_page', 15), 100);
        $products = $this->productService->getVendorProducts($vendor->id, $perPage);

        return response()->json($products);
    }

    /**
     * Get Product Details
     * 
     * Retrieve detailed information about a product/service including variants or slots.
     * 
     * @urlParam product integer required The product ID. Example: 1
     * 
     * @response {
     *   "data": {
     *     "id": 1,
     *     "vendor_id": 1,
     *     "title": "Web Development Package",
     *     "brief": "Professional website development",
     *     "description": "Full description here...",
     *     "type": "service",
     *     "active": true,
     *     "vendor": {
     *       "id": 1,
     *       "business_name": "Tech Solutions Inc"
     *     },
     *     "variants": [],
     *     "service_slots": []
     *   }
     * }
     */
    public function show(Product $product): JsonResponse
    {
        $product = $this->productService->getProductWithDetails($product->id);

        return response()->json([
            'data' => $product,
        ]);
    }

    /**
     * Update Product/Service
     * 
     * Update product/service details. Only vendor owner can update.
     * 
     * @authenticated
     * 
     * @urlParam product integer required The product ID. Example: 1
     * 
     * @bodyParam title string optional Product title. Example: Updated Web Package
     * @bodyParam brief string optional Short description. Example: Updated description
     * @bodyParam description string optional Detailed description. Example: New detailed info...
     * @bodyParam type string optional Type: "product" or "service". Example: service
     * @bodyParam active boolean optional Active status. Example: false
     * 
     * @response {
     *   "message": "Product updated successfully",
     *   "data": {
     *     "id": 1,
     *     "title": "Updated Web Package",
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product = $this->productService->updateProduct(
            $product,
            $request->validated()
        );

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }

    /**
     * Delete Product/Service
     * 
     * Delete a product/service. Only vendor owner can delete.
     * 
     * @authenticated
     * 
     * @urlParam product integer required The product ID. Example: 1
     * 
     * @response {
     *   "message": "Product deleted successfully"
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);
        
        $this->productService->deleteProduct($product);

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
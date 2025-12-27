<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreVendorRequest;
use App\Http\Requests\Vendors\UpdateVendorRequest;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;

/**
 * @group Vendor Management
 * 
 * APIs for managing vendors
 */
class VendorController extends Controller
{
    public function __construct(
        protected VendorService $vendorService
    ) {}

    /**
     * Create Vendor
     * 
     * Register a new vendor with business details.
     * 
     * @authenticated
     * 
     * @bodyParam business_name string required The business name. Example: Tech Solutions Inc
     * @bodyParam brief string required Brief description of the business. Example: We provide IT consulting services
     * @bodyParam category array required Array of business categories. Example: ["IT", "Consulting"]
     * @bodyParam website string optional Business website URL. Example: https://techsolutions.com
     * @bodyParam street_address string optional Street address. Example: 123 Main St
     * @bodyParam city string City (required if street_address is provided). Example: New York
     * @bodyParam state_province string State/Province (required if street_address is provided). Example: NY
     * @bodyParam postal_code string optional Postal/ZIP code. Example: 10001
     * 
     * @response 201 {
     *   "message": "Vendor created successfully",
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "business_name": "Tech Solutions Inc",
     *     "brief": "We provide IT consulting services",
     *     "category": ["IT", "Consulting"],
     *     "website": "https://techsolutions.com",
     *     "verified_at": null,
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     */
    public function store(StoreVendorRequest $request): JsonResponse
    {
        $vendor = $this->vendorService->createVendor(
            auth()->id(),
            $request->validated()
        );

        return response()->json([
            'message' => 'Vendor created successfully',
            'data' => $vendor,
        ], 201);
    }

    /**
     * Get Vendor Details
     * 
     * Retrieve detailed information about a specific vendor.
     * 
     * @urlParam vendor integer required The vendor ID. Example: 1
     * 
     * @response {
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "business_name": "Tech Solutions Inc",
     *     "brief": "We provide IT consulting services",
     *     "category": ["IT", "Consulting"],
     *     "average_rating": 4.5,
     *     "review_count": 20,
     *     "is_verified": true,
     *     "products": []
     *   }
     * }
     */
    public function show(Vendor $vendor): JsonResponse
    {
        $vendor = $this->vendorService->getVendorWithDetails($vendor->id);

        return response()->json([
            'data' => $vendor,
        ]);
    }

    /**
     * Update Vendor
     * 
     * Update vendor information. Only the vendor owner can update.
     * 
     * @authenticated
     * 
     * @urlParam vendor integer required The vendor ID. Example: 1
     * 
     * @bodyParam business_name string optional The business name. Example: Tech Solutions Inc
     * @bodyParam brief string optional Brief description. Example: Updated description
     * @bodyParam category array optional Array of categories. Example: ["IT", "Software"]
     * @bodyParam website string optional Business website. Example: https://newtechsolutions.com
     * @bodyParam street_address string optional Street address. Example: 456 Oak Ave
     * @bodyParam city string City (required if street_address is provided). Example: Boston
     * @bodyParam state_province string State (required if street_address is provided). Example: MA
     * @bodyParam postal_code string optional Postal code. Example: 02101
     * 
     * @response {
     *   "message": "Vendor updated successfully",
     *   "data": {
     *     "id": 1,
     *     "business_name": "Tech Solutions Inc",
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor): JsonResponse
    {
        $vendor = $this->vendorService->updateVendor(
            $vendor,
            $request->validated()
        );

        return response()->json([
            'message' => 'Vendor updated successfully',
            'data' => $vendor,
        ]);
    }

    /**
     * Verify Vendor
     * 
     * Verify a vendor (admin only). Verified vendors appear in public listings.
     * 
     * @authenticated
     * 
     * @urlParam vendor integer required The vendor ID. Example: 1
     * 
     * @response {
     *   "message": "Vendor verified successfully",
     *   "data": {
     *     "id": 1,
     *     "verified_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function verify(Vendor $vendor): JsonResponse
    {
        $this->authorize('verify', $vendor);
        
        $vendor = $this->vendorService->verifyVendor($vendor);

        return response()->json([
            'message' => 'Vendor verified successfully',
            'data' => $vendor,
        ]);
    }
}
<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\ReviewVendorRequest;
use App\Http\Requests\Vendors\StoreVendorRequest;
use App\Http\Requests\Vendors\UpdateVendorRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     *   "message": "Vendor created successfully. Pending admin approval.",
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "business_name": "Tech Solutions Inc",
     *     "brief": "We provide IT consulting services",
     *     "category": ["IT", "Consulting"],
     *     "website": "https://techsolutions.com",
     *     "status": "pending",
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
            'message' => 'Vendor created successfully. Pending admin approval.',
            'data' => new VendorResource($vendor),
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
     *     "status": "approved",
     *     "products": []
     *   }
     * }
     */
    public function show(Vendor $vendor): JsonResponse
    {
        $vendor = $this->vendorService->getVendorWithDetails($vendor->id);

        return response()->json([
            'data' => new VendorResource($vendor),
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
            'data' => new VendorResource($vendor),
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
            'data' => new VendorResource($vendor),
        ]);
    }

    // ─── Admin Methods ────────────────────────────────────────────────────────

    /**
     * List All Vendors (Admin)
     * 
     * Retrieve all vendors with optional status filtering. Admin access required.
     * 
     * @authenticated
     * 
     * @queryParam status string Filter by status: "pending", "approved", or "rejected". Example: pending
     * @queryParam per_page integer Number of results per page. Example: 15
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "business_name": "Tech Solutions Inc",
     *       "status": "pending",
     *       "user": { "id": 1, "name": "John Doe", "email": "john@example.com" },
     *       "created_at": "2024-01-01T00:00:00.000000Z"
     *     }
     *   ],
     *   "meta": { "current_page": 1, "last_page": 3, "per_page": 15, "total": 42 }
     * }
     * 
     * @response 403 {
     *   "message": "Unauthorized."
     * }
     */
    public function index(Request $request): JsonResponse
    {
        if (!auth('admin')->check()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $vendors = $this->vendorService->getAllVendors(
            filters: ['status' => $request->get('status')],
            perPage: $request->get('per_page', 15)
        );

        return response()->json([
            'success' => true,
            'data' => VendorResource::collection($vendors),
            'meta' => [
                'current_page' => $vendors->currentPage(),
                'last_page' => $vendors->lastPage(),
                'per_page' => $vendors->perPage(),
                'total' => $vendors->total(),
            ],
        ]);
    }

    /**
     * Get Vendor Details (Admin)
     * 
     * Retrieve full details of any vendor including review history. Admin access required.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The vendor ID. Example: 1
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "business_name": "Tech Solutions Inc",
     *     "status": "pending",
     *     "user": { "id": 1, "name": "John Doe", "email": "john@example.com" },
     *     "admin_notes": null,
     *     "rejection_reason": null,
     *     "reviewed_at": null
     *   }
     * }
     * 
     * @response 404 {
     *   "message": "Vendor not found."
     * }
     */
    public function adminShow(int $id): JsonResponse
    {
        if (!auth('admin')->check()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $vendor = $this->vendorService->getVendorWithDetails($id);

        if (!$vendor) {
            return response()->json(['message' => 'Vendor not found.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new VendorResource($vendor),
        ]);
    }

    /**
     * Review Vendor (Admin)
     * 
     * Approve or reject a vendor application. Admin access required.
     * When approved, verified_at is set and the vendor becomes publicly visible.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The vendor ID. Example: 1
     * 
     * @bodyParam action string required Action to take: "approve" or "reject". Example: approve
     * @bodyParam rejection_reason string optional Reason for rejection (required if action is "reject"). Example: Insufficient business information provided.
     * @bodyParam admin_notes string optional Internal notes not shown to vendor owner. Example: Follow up in 30 days.
     * 
     * @response 200 {
     *   "success": true,
     *   "message": "Vendor approved successfully.",
     *   "data": { "id": 1, "status": "approved", "verified_at": "2024-01-01T00:00:00.000000Z" }
     * }
     * 
     * @response 200 {
     *   "success": true,
     *   "message": "Vendor rejected.",
     *   "data": { "id": 1, "status": "rejected", "rejection_reason": "Insufficient information." }
     * }
     * 
     * @response 400 {
     *   "success": false,
     *   "message": "Vendor has already been reviewed."
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Vendor not found."
     * }
     */
    public function review(ReviewVendorRequest $request, int $id): JsonResponse
    {
        $vendor = $this->vendorService->getVendorWithDetails($id);

        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Vendor not found.'], 404);
        }

        if (!$vendor->isPending()) {
            return response()->json(['success' => false, 'message' => 'Vendor has already been reviewed.'], 400);
        }

        $validated = $request->validated();
        $admin = auth('admin')->user();

        if ($validated['action'] === 'approve') {
            $vendor = $this->vendorService->approveVendor(
                $vendor,
                $admin,
                $validated['admin_notes'] ?? null
            );

            return response()->json([
                'success' => true,
                'message' => 'Vendor approved successfully.',
                'data' => new VendorResource($vendor),
            ]);
        } else {
            $vendor = $this->vendorService->rejectVendor(
                $vendor,
                $admin,
                $validated['rejection_reason'],
                $validated['admin_notes'] ?? null
            );

            return response()->json([
                'success' => true,
                'message' => 'Vendor rejected.',
                'data' => new VendorResource($vendor),
            ]);
        }
    }
}
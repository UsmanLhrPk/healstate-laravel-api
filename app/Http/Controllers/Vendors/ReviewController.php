<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\StoreReviewRequest;
use App\Models\Vendor;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Vendor Reviews
 * 
 * APIs for managing vendor ratings and reviews
 */
class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    /**
     * Add Review
     * 
     * Submit a rating for a vendor.
     * 
     * @authenticated
     * 
     * @urlParam vendor integer required The vendor ID. Example: 1
     * 
     * @bodyParam rating integer required Rating from 1-5. Example: 5
     * 
     * @response 201 {
     *   "message": "Review created successfully",
     *   "data": {
     *     "id": 1,
     *     "vendor_id": 1,
     *     "user_id": 1,
     *     "rating": 5,
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     */
    public function store(StoreReviewRequest $request, Vendor $vendor): JsonResponse
    {
        $review = $this->reviewService->createReview(
            $vendor,
            auth()->id(),
            $request->validated()
        );

        return response()->json([
            'message' => 'Review created successfully',
            'data' => $review,
        ], 201);
    }

    /**
     * List Vendor Reviews
     * 
     * Get all reviews for a vendor with pagination.
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
     *       "vendor_id": 1,
     *       "user_id": 1,
     *       "rating": 5,
     *       "user": {
     *         "id": 1,
     *         "name": "John Doe"
     *       },
     *       "created_at": "2024-01-01T00:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "vendor_id": 1,
     *       "user_id": 2,
     *       "rating": 4,
     *       "user": {
     *         "id": 2,
     *         "name": "Jane Smith"
     *       },
     *       "created_at": "2024-01-02T00:00:00.000000Z"
     *     }
     *   ],
     *   "links": {
     *     "first": "http://localhost/api/vendors/1/reviews?page=1",
     *     "last": "http://localhost/api/vendors/1/reviews?page=5",
     *     "prev": null,
     *     "next": "http://localhost/api/vendors/1/reviews?page=2"
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 5,
     *     "per_page": 15,
     *     "to": 15,
     *     "total": 73
     *   }
     * }
     */
    public function index(Request $request, Vendor $vendor): JsonResponse
    {
        $perPage = min($request->input('per_page', 15), 100);
        $reviews = $this->reviewService->getVendorReviews($vendor->id, $perPage);

        return response()->json($reviews);
    }
}
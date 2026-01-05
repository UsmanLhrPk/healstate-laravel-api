<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\MarketplaceRequest;
use App\Services\MarketplaceService;
use Illuminate\Http\JsonResponse;

/**
 * @group Marketplace
 * 
 * APIs for browsing marketplace products and services
 */
class MarketplaceController extends Controller
{
    public function __construct(
        protected MarketplaceService $marketplaceService
    ) {}

    /**
     * Get Marketplace Products
     * 
     * Retrieve paginated list of all active products and services from verified vendors.
     * Supports filtering by type, category, search, and sorting.
     * 
     * @queryParam type string Filter by product type. Allowed values: product, service. Example: product
     * @queryParam category string Filter by vendor category. Example: Photography
     * @queryParam search string Search in title and brief. Example: wedding
     * @queryParam sort string Sort results. Allowed values: latest, price_low, price_high, rating. Default: latest. Example: latest
     * @queryParam page integer Page number for pagination. Default: 1. Example: 1
     * @queryParam per_page integer Items per page. Default: 12. Example: 12
     * 
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "vendor_id": 1,
     *       "title": "Professional Photography Session",
     *       "brief": "Capture your special moments",
     *       "description": "Full description here",
     *       "type": "service",
     *       "image_url": "https://example.com/image.jpg",
     *       "active": true,
     *       "variants": [],
     *       "service_slots": [
     *         {
     *           "id": 1,
     *           "duration": 60,
     *           "price": "150.00"
     *         }
     *       ],
     *       "vendor": {
     *         "id": 1,
     *         "business_name": "Pixel Perfect Studios",
     *         "category": ["Photography", "Videography"],
     *         "city": "New York",
     *         "average_rating": 4.8,
     *         "review_count": 127,
     *         "is_verified": true
     *       },
     *       "min_price": "150.00",
     *       "created_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   ],
     *   "current_page": 1,
     *   "last_page": 3,
     *   "per_page": 12,
     *   "total": 32
     * }
     */
    public function index(MarketplaceRequest $request): JsonResponse
    {
        $products = $this->marketplaceService->getMarketplaceProducts(
            $request->validated()
        );

        return response()->json($products);
    }
}
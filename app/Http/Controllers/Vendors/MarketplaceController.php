<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendors\MarketplaceRequest;
use App\Services\MarketplaceService;
use Illuminate\Http\JsonResponse;

/**
 * @group Marketplace
 *
 * APIs for browsing marketplace products from approved vendors.
 * Only products from vendors with an approved status are listed.
 * Practitioner services are browsed separately via Practitioner Offerings.
 */
class MarketplaceController extends Controller
{
    public function __construct(
        protected MarketplaceService $marketplaceService
    ) {}

    /**
     * Get Marketplace Products
     *
     * Retrieve a paginated list of active products from approved vendors.
     * Supports filtering by category, search, and sorting.
     * Public endpoint, no authentication required.
     *
     * @queryParam category string Filter by vendor category. Example: Photography
     * @queryParam search string Search in product title, brief, and description. Example: wedding
     * @queryParam sort string Sort results. Allowed values: latest, price_low, price_high, rating. Default: latest. Example: latest
     * @queryParam page integer Page number for pagination. Default: 1. Example: 1
     * @queryParam per_page integer Items per page. Default: 12. Example: 12
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "vendor_id": 1,
     *       "title": "Yoga Mat Pro",
     *       "brief": "Premium non-slip yoga mat",
     *       "description": "High-density foam with alignment lines...",
     *       "image_url": "https://example.com/image.jpg",
     *       "active": true,
     *       "variants": [
     *         {
     *           "id": 1,
     *           "name": "Large",
     *           "price": "49.99",
     *           "stock": 100
     *         }
     *       ],
     *       "vendor": {
     *         "id": 1,
     *         "business_name": "Wellness Supplies Co",
     *         "category": ["Wellness", "Fitness"],
     *         "city": "New York",
     *         "average_rating": 4.8,
     *         "review_count": 127,
     *         "is_verified": true
     *       },
     *       "min_price": "49.99",
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
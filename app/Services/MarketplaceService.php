<?php

namespace App\Services;

use App\Http\Resources\MarketplaceProductResource;
use App\Models\Product;

class MarketplaceService
{
    public function getMarketplaceProducts(array $filters): array
    {
        $query = Product::query()
            ->with([
                'vendor' => function ($query) {
                    $query->withCount('reviews')
                        ->withAvg('reviews', 'rating');
                },
                'variants',
            ])
            ->whereHas('vendor', function ($query) {
                $query->where('status', 'approved');
            })
            ->where('active', true);

        // Filter by category (vendor category)
        if (! empty($filters['category'])) {
            $query->whereHas('vendor', function ($q) use ($filters) {
                $q->whereJsonContains('category', $filters['category']);
            });
        }

        // Search in title and brief
        if (! empty($filters['search'])) {
            $searchTerm = $filters['search'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('brief', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Apply sorting
        switch ($filters['sort']) {
            case 'price_low':
                $query->addSelect([
                    'min_price' => function ($query) {
                        $query->selectRaw('COALESCE((SELECT MIN(price) FROM product_variants WHERE product_id = products.id), 999999)');
                    },
                ])->orderBy('min_price', 'asc');
                break;

            case 'price_high':
                $query->addSelect([
                    'max_price' => function ($query) {
                        $query->selectRaw('COALESCE((SELECT MAX(price) FROM product_variants WHERE product_id = products.id), 0)');
                    },
                ])->orderBy('max_price', 'desc');
                break;

            case 'rating':
                $query->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                    ->leftJoin('vendor_reviews', 'vendors.id', '=', 'vendor_reviews.vendor_id')
                    ->select('products.*')
                    ->groupBy('products.id')
                    ->orderByRaw('ISNULL(AVG(vendor_reviews.rating)) ASC, AVG(vendor_reviews.rating) DESC');
                break;

            case 'latest':
            default:
                $query->latest('products.created_at');
                break;
        }

        $products = $query->paginate($filters['per_page'], ['*'], 'page', $filters['page']);

        return [
            'data' => MarketplaceProductResource::collection($products->items())->resolve(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total(),
        ];
    }
}

<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Http\Resources\Practitioners\ServiceCategoryResource;
use App\Http\Resources\Practitioners\ServiceSubcategoryResource;
use App\Services\ServiceCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Service Categories
 * 
 * APIs for browsing practitioner service categories and subcategories
 */
class ServiceCategoryController extends Controller
{
    public function __construct(
        protected ServiceCategoryService $categoryService
    ) {}

    /**
     * Get All Service Categories
     * 
     * Retrieve all active service categories with optional subcategories.
     * Returns the 5 main categories: Body-Based, Mind-Based, Spirit-Based, 
     * Frequency & Technology, and Integrated Services.
     * 
     * @queryParam include_subcategories boolean Include subcategories in response. Defaults to true. Example: true
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Body-Based Services",
     *       "slug": "body-based-services",
     *       "description": "Physical healing modalities that work with the body",
     *       "display_order": 1,
     *       "is_active": true,
     *       "active_subcategories": [
     *         {
     *           "id": 1,
     *           "category_id": 1,
     *           "name": "Massage Therapy",
     *           "slug": "massage-therapy",
     *           "display_order": 1,
     *           "is_active": true
     *         }
     *       ]
     *     }
     *   ]
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $includeSubcategories = $request->boolean('include_subcategories', true);
        $categories = $this->categoryService->getAllCategories($includeSubcategories);

        return response()->json([
            'success' => true,
            'data' => ServiceCategoryResource::collection($categories),
        ]);
    }

    /**
     * Get Category by ID
     * 
     * Retrieve a specific service category with its subcategories.
     * 
     * @urlParam id integer required The category ID. Example: 1
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "name": "Body-Based Services",
     *     "slug": "body-based-services",
     *     "description": "Physical healing modalities",
     *     "active_subcategories": [
     *       {
     *         "id": 1,
     *         "name": "Massage Therapy",
     *         "slug": "massage-therapy"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Category not found."
     * }
     */
    public function show(int $id): JsonResponse
    {
        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ServiceCategoryResource($category),
        ]);
    }

    /**
     * Get Category by Slug
     * 
     * Retrieve a service category using its URL-friendly slug.
     * 
     * @urlParam slug string required The category slug. Example: body-based-services
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "name": "Body-Based Services",
     *     "slug": "body-based-services",
     *     "active_subcategories": []
     *   }
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Category not found."
     * }
     */
    public function showBySlug(string $slug): JsonResponse
    {
        $category = $this->categoryService->getCategoryBySlug($slug);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ServiceCategoryResource($category),
        ]);
    }

    /**
     * Get Category Subcategories
     * 
     * Retrieve all subcategories for a specific service category.
     * 
     * @urlParam categoryId integer required The category ID. Example: 1
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "category_id": 1,
     *       "name": "Massage Therapy",
     *       "slug": "massage-therapy",
     *       "description": null,
     *       "display_order": 1,
     *       "is_active": true
     *     },
     *     {
     *       "id": 2,
     *       "category_id": 1,
     *       "name": "Acupuncture",
     *       "slug": "acupuncture",
     *       "display_order": 2,
     *       "is_active": true
     *     }
     *   ]
     * }
     */
    public function subcategories(int $categoryId): JsonResponse
    {
        $subcategories = $this->categoryService->getSubcategoriesForCategory($categoryId);

        return response()->json([
            'success' => true,
            'data' => ServiceSubcategoryResource::collection($subcategories),
        ]);
    }
}
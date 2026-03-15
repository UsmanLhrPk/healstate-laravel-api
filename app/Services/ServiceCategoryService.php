<?php

namespace App\Services;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Support\Collection;

class ServiceCategoryService
{
    /**
     * Get all active service categories with their subcategories.
     */
    public function getAllCategories(bool $includeSubcategories = true): Collection
    {
        $query = ServiceCategory::active()->ordered();

        if ($includeSubcategories) {
            $query->with(['activeSubcategories' => function ($q) {
                $q->ordered();
            }]);
        }

        return $query->get();
    }

    /**
     * Get a specific category by ID with subcategories.
     */
    public function getCategoryById(int $id): ?ServiceCategory
    {
        return ServiceCategory::with(['activeSubcategories' => function ($q) {
            $q->ordered();
        }])->find($id);
    }

    /**
     * Get a category by slug.
     */
    public function getCategoryBySlug(string $slug): ?ServiceCategory
    {
        return ServiceCategory::with(['activeSubcategories' => function ($q) {
            $q->ordered();
        }])
            ->where('slug', $slug)
            ->active()
            ->first();
    }

    /**
     * Get subcategories for a specific category.
     */
    public function getSubcategoriesForCategory(int $categoryId): Collection
    {
        return ServiceSubcategory::with('category')
            ->forCategory($categoryId)
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Get a specific subcategory by ID.
     */
    public function getSubcategoryById(int $id): ?ServiceSubcategory
    {
        return ServiceSubcategory::with('category')->find($id);
    }

    /**
     * Validate that subcategories belong to a category.
     */
    public function validateSubcategoriesForCategory(int $categoryId, array $subcategoryIds): bool
    {
        $count = ServiceSubcategory::where('category_id', $categoryId)
            ->whereIn('id', $subcategoryIds)
            ->count();

        return $count === count($subcategoryIds);
    }
}
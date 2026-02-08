<?php

namespace App\Services;

use App\Models\PractitionerProfile;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PractitionerProfileService
{
    /**
     * Get all active practitioner profiles.
     */
    public function getAllProfiles(array $filters = []): LengthAwarePaginator
    {
        $query = PractitionerProfile::with([
            'user',
            'primaryCategory',
            'services'
        ])->active();

        // Filter by category
        if (!empty($filters['category_id'])) {
            $query->byCategory($filters['category_id']);
        }

        // Filter by accepting clients
        if (isset($filters['accepting_clients']) && $filters['accepting_clients']) {
            $query->acceptingClients();
        }

        // Filter by service
        if (!empty($filters['service_id'])) {
            $query->whereHas('services', function ($q) use ($filters) {
                $q->where('service_subcategories.id', $filters['service_id']);
            });
        }

        // Search by name or title
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('professional_title', 'like', '%' . $filters['search'] . '%')
                    ->orWhereHas('user', function ($userQuery) use ($filters) {
                        $userQuery->where('name', 'like', '%' . $filters['search'] . '%');
                    });
            });
        }

        // Sort options
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';

        switch ($sortBy) {
            case 'rating':
                $query->topRated();
                break;
            case 'bookings':
                $query->orderBy('total_bookings', $sortOrder);
                break;
            default:
                $query->orderBy($sortBy, $sortOrder);
        }

        $perPage = $filters['per_page'] ?? 15;
        return $query->paginate($perPage);
    }

    /**
     * Get a practitioner profile by ID.
     */
    public function getProfileById(int $id): ?PractitionerProfile
    {
        return PractitionerProfile::with([
            'user',
            'primaryCategory',
            'services',
            'application'
        ])->find($id);
    }

    /**
     * Get a practitioner profile by user ID.
     */
    public function getProfileByUserId(int $userId): ?PractitionerProfile
    {
        return PractitionerProfile::with([
            'primaryCategory',
            'services'
        ])->where('user_id', $userId)->first();
    }

    /**
     * Update practitioner profile.
     */
    public function updateProfile(PractitionerProfile $profile, array $data): PractitionerProfile
    {
        $profile->update($data);

        // Update services if provided
        if (isset($data['service_subcategories'])) {
            $profile->services()->sync($data['service_subcategories']);
        }

        return $profile->fresh(['primaryCategory', 'services']);
    }

    /**
     * Toggle profile active status.
     */
    public function toggleActiveStatus(PractitionerProfile $profile): PractitionerProfile
    {
        $profile->update(['is_active' => !$profile->is_active]);
        return $profile;
    }

    /**
     * Toggle accepting clients status.
     */
    public function toggleAcceptingClients(PractitionerProfile $profile): PractitionerProfile
    {
        $profile->update(['is_accepting_clients' => !$profile->is_accepting_clients]);
        return $profile;
    }

    /**
     * Get top-rated practitioners.
     */
    public function getTopRatedPractitioners(int $limit = 10): Collection
    {
        return PractitionerProfile::with([
            'user',
            'primaryCategory',
            'services'
        ])
            ->active()
            ->acceptingClients()
            ->topRated()
            ->limit($limit)
            ->get();
    }

    /**
     * Get practitioners by category.
     */
    public function getPractitionersByCategory(int $categoryId, int $limit = 10): Collection
    {
        return PractitionerProfile::with([
            'user',
            'primaryCategory',
            'services'
        ])
            ->active()
            ->acceptingClients()
            ->byCategory($categoryId)
            ->topRated()
            ->limit($limit)
            ->get();
    }
}
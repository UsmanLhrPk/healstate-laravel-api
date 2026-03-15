<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VendorService
{
    public function createVendor(int $userId, array $data): Vendor
    {
        return DB::transaction(function () use ($userId, $data) {
            $data['user_id'] = $userId;
            $data['status'] = Vendor::STATUS_PENDING;
            return Vendor::create($data);
        });
    }

    public function updateVendor(Vendor $vendor, array $data): Vendor
    {
        DB::transaction(function () use ($vendor, $data) {
            $fillableData = array_intersect_key($data, array_flip($vendor->getFillable()));
            $vendor->update($fillableData);
        });

        return $vendor->fresh();
    }

    public function approveVendor(Vendor $vendor, Admin $admin, ?string $adminNotes = null): Vendor
    {
        $vendor->update([
            'status' => Vendor::STATUS_APPROVED,
            'verified_at' => now(),
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'admin_notes' => $adminNotes,
            'rejection_reason' => null,
        ]);

        return $vendor->fresh(['user', 'reviewer']);
    }

    public function rejectVendor(Vendor $vendor, Admin $admin, string $rejectionReason, ?string $adminNotes = null): Vendor
    {
        $vendor->update([
            'status' => Vendor::STATUS_REJECTED,
            'verified_at' => null,
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'rejection_reason' => $rejectionReason,
            'admin_notes' => $adminNotes,
        ]);

        return $vendor->fresh(['user', 'reviewer']);
    }

    public function verifyVendor(Vendor $vendor): Vendor
    {
        $vendor->update(['verified_at' => now()]);
        return $vendor->fresh();
    }

    public function getVendorWithDetails(int $vendorId): ?Vendor
    {
        return Vendor::with(['products', 'reviews', 'user', 'reviewer'])
            ->withCount('reviews')
            ->find($vendorId);
    }

    public function getVerifiedVendors(int $perPage = 15): LengthAwarePaginator
    {
        return Vendor::whereNotNull('verified_at')
            ->with(['products', 'reviews'])
            ->withCount('reviews')
            ->latest()
            ->paginate($perPage);
    }

    public function getAllVendors(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Vendor::with(['user', 'reviews', 'reviewer'])
            ->withCount('reviews')
            ->latest();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->paginate($perPage);
    }
}
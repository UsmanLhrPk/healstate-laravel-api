<?php

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VendorService
{
    public function createVendor(int $userId, array $data): Vendor
    {
        return DB::transaction(function () use ($userId, $data) {
            $data['user_id'] = $userId;
            return Vendor::create($data);
        });
    }

    public function updateVendor(Vendor $vendor, array $data): Vendor
    {
        DB::transaction(function () use ($vendor, $data) {
            $vendor->update($data);
        });

        return $vendor->fresh();
    }

    public function verifyVendor(Vendor $vendor): Vendor
    {
        $vendor->update(['verified_at' => now()]);
        return $vendor->fresh();
    }

    public function getVendorWithDetails(int $vendorId): ?Vendor
    {
        return Vendor::with(['products', 'reviews'])
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

    public function getAllVendors(int $perPage = 15): LengthAwarePaginator
    {
        return Vendor::with(['products', 'reviews'])
            ->withCount('reviews')
            ->latest()
            ->paginate($perPage);
    }
}
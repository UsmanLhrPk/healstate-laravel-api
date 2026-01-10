<?php

namespace App\Services;

use App\Models\Vendor;
use App\Models\VendorReview;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    public function createReview(Vendor $vendor, int $userId, array $data): VendorReview
    {
        return DB::transaction(function () use ($vendor, $userId, $data) {
            $data['vendor_id'] = $vendor->id;
            $data['user_id'] = $userId;
            
            return VendorReview::create($data);
        });
    }

    public function getVendorReviews(int $vendorId, int $perPage = 15): LengthAwarePaginator
    {
        return VendorReview::where('vendor_id', $vendorId)
            ->with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
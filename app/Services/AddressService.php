<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AddressService
{
    public function createAddress(int $userId, array $data): Address
    {
        return DB::transaction(function () use ($userId, $data) {
            $data['user_id'] = $userId;

            // If this is set as default or it's the first address, set as default
            if (($data['is_default'] ?? false) || !Address::where('user_id', $userId)->exists()) {
                $data['is_default'] = true;
            }

            return Address::create($data);
        });
    }

    public function getUserAddresses(int $userId): Collection
    {
        return Address::where('user_id', $userId)
            ->orderByDesc('is_default')
            ->orderByDesc('created_at')
            ->get();
    }

    public function updateAddress(Address $address, array $data): Address
    {
        DB::transaction(function () use ($address, $data) {
            $address->update($data);
        });

        return $address->fresh();
    }

    public function deleteAddress(Address $address): bool
    {
        return DB::transaction(function () use ($address) {
            $wasDefault = $address->is_default;
            $userId = $address->user_id;

            $address->delete();

            // If we deleted the default address, make another one default
            if ($wasDefault) {
                Address::where('user_id', $userId)
                    ->latest()
                    ->first()
                    ?->update(['is_default' => true]);
            }

            return true;
        });
    }

    public function getDefaultAddress(int $userId): ?Address
    {
        return Address::where('user_id', $userId)
            ->where('is_default', true)
            ->first();
    }

    public function setDefaultAddress(Address $address): Address
    {
        DB::transaction(function () use ($address) {
            Address::where('user_id', $address->user_id)
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);

            $address->update(['is_default' => true]);
        });

        return $address->fresh();
    }
}
<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ServiceSlot;
use Illuminate\Support\Facades\DB;

class SlotService
{
    public function createSlot(Product $product, array $data): ServiceSlot
    {
        return DB::transaction(function () use ($product, $data) {
            $data['product_id'] = $product->id;
            return ServiceSlot::create($data);
        });
    }

    public function updateSlot(ServiceSlot $slot, array $data): ServiceSlot
    {
        DB::transaction(function () use ($slot, $data) {
            $slot->update($data);
        });

        return $slot->fresh();
    }

    public function deleteSlot(ServiceSlot $slot): bool
    {
        return DB::transaction(function () use ($slot) {
            return $slot->delete();
        });
    }
}
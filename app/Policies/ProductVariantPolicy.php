<?php

namespace App\Policies;

use App\Models\ProductVariant;
use App\Models\User;

class ProductVariantPolicy
{
    public function update(User $user, ProductVariant $variant): bool
    {
        return $user->id === $variant->product->vendor->user_id;
    }

    public function delete(User $user, ProductVariant $variant): bool
    {
        return $user->id === $variant->product->vendor->user_id;
    }
}
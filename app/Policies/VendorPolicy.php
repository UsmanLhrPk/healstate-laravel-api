<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

class VendorPolicy
{
    public function verify(User $user, Vendor $vendor): bool
    {
        return true;
    }

    public function update(User $user, Vendor $vendor): bool
    {
        return $user->id === $vendor->user_id;
    }

    public function delete(User $user, Vendor $vendor): bool
    {
        return $user->id === $vendor->user_id;
    }
}
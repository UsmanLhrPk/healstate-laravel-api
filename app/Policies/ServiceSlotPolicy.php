<?php

namespace App\Policies;

use App\Models\ServiceSlot;
use App\Models\User;

class ServiceSlotPolicy
{
    public function update(User $user, ServiceSlot $slot): bool
    {
        return $user->id === $slot->product->vendor->user_id;
    }

    public function delete(User $user, ServiceSlot $slot): bool
    {
        return $user->id === $slot->product->vendor->user_id;
    }
}
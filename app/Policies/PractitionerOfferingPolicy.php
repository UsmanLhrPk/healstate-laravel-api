<?php

namespace App\Policies;

use App\Models\PractitionerOffering;
use App\Models\User;

class PractitionerOfferingPolicy
{
    public function update(User $user, PractitionerOffering $offering): bool
    {
        return $user->id === $offering->practitionerProfile->user_id;
    }

    public function delete(User $user, PractitionerOffering $offering): bool
    {
        return $user->id === $offering->practitionerProfile->user_id;
    }
}

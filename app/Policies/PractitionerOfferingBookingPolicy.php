<?php

namespace App\Policies;

use App\Models\PractitionerOfferingBooking;
use App\Models\User;

class PractitionerOfferingBookingPolicy
{
    public function cancel(User $user, PractitionerOfferingBooking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    public function view(User $user, PractitionerOfferingBooking $booking): bool
    {
        return $user->id === $booking->user_id
            || $user->id === $booking->slot->offering->practitionerProfile->user_id;
    }
}

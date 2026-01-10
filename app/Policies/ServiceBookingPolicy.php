<?php

namespace App\Policies;

use App\Models\ServiceBooking;
use App\Models\User;

class ServiceBookingPolicy
{
    public function cancel(User $user, ServiceBooking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    public function view(User $user, ServiceBooking $booking): bool
    {
        return $user->id === $booking->user_id;
    }
}
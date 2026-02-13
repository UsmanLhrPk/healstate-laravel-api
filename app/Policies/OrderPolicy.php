<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine if the user can view the order
     */
    public function view(User $user, Order $order): bool
    {
        // User can view their own order
        if ($user->id === $order->user_id) {
            return true;
        }

        // Vendor can view orders containing their products
        if ($user->vendor) {
            $vendorIds = $order->getVendorIds();
            return in_array($user->vendor->id, $vendorIds);
        }

        return false;
    }

    /**
     * Determine if the user can cancel the order
     */
    public function cancel(User $user, Order $order): bool
    {
        // Only the order owner can cancel
        if ($user->id !== $order->user_id) {
            return false;
        }

        // Can cancel if status allows it
        return in_array($order->status, ['pending', 'paid', 'processing']);
    }

    /**
     * Determine if the user can request cancellation
     */
    public function requestCancellation(User $user, Order $order): bool
    {
        return $user->id === $order->user_id 
            && $order->canRequestCancellation();
    }

    /**
     * Determine if the vendor can update order status
     */
    public function updateStatus(User $user, Order $order): bool
    {
        // User must be a vendor
        if (!$user->vendor) {
            return false;
        }

        // Vendor must be associated with this order
        $vendorIds = $order->getVendorIds();
        return in_array($user->vendor->id, $vendorIds);
    }

    /**
     * Determine if the vendor can approve/deny cancellation
     */
    public function manageCancellation(User $user, Order $order): bool
    {
        // User must be a vendor
        if (!$user->vendor) {
            return false;
        }

        // Order must have a pending cancellation request
        if ($order->status !== 'cancellation_requested') {
            return false;
        }

        // Vendor must be associated with this order
        $vendorIds = $order->getVendorIds();
        return in_array($user->vendor->id, $vendorIds);
    }
}
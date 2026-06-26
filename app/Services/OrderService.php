<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Order;
use App\Models\PractitionerOfferingBooking;
use App\Models\ServiceBooking;
use App\Notifications\OrderCancellationRequestNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function __construct(
        protected CartService $cartService,
        protected PaymentService $paymentService
    ) {}

    // ─────────────────────────────────────────────────────────────────────────
    // ORDER CREATION (multi‑currency)
    // ─────────────────────────────────────────────────────────────────────────

    public function createOrderForCurrency(?int $userId, ?string $sessionId, string $currency, array $data, Address $address): Order
    {
        return DB::transaction(function () use ($userId, $sessionId, $currency, $data, $address) {
            $cartItems = $this->cartService->getCart($userId, $sessionId)->filter(function ($item) use ($currency) {
                if ($item->product_id && $item->product) {
                    $itemCurrency = $item->product->currency ?? $item->product->vendor->currency ?? 'USD';
                } elseif ($item->service_slot_id && $item->serviceSlot) {
                    $itemCurrency = $item->serviceSlot->product->currency ?? $item->serviceSlot->product->vendor->currency ?? 'USD';
                } elseif ($item->practitioner_offering_slot_id) {
                    $itemCurrency = 'USD';
                } elseif ($item->course_id && $item->course) {
                    $itemCurrency = $item->course->currency ?? 'USD';
                } else {
                    $itemCurrency = 'USD';
                }

                return $itemCurrency === $currency;
            });

            if ($cartItems->isEmpty()) {
                throw new \Exception("No cart items found for currency {$currency}");
            }

            Log::info('Cart items for order creation (currency: '.$currency.')', [
                'count' => $cartItems->count(),
                'first_item' => $cartItems->first()?->toArray(),
            ]);

            $totals = $this->cartService->calculateCartTotalsForCurrency($userId, $sessionId, $currency);

            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $address->id,
                'subtotal' => $totals['subtotal'],
                'shipping' => $totals['shipping'],
                'total' => $totals['total'],
                'status' => 'pending',
                'payment_intent_id' => $data['payment_intent_id'] ?? null,
                'order_notes' => $data['order_notes'] ?? null,
                'currency' => $currency,
                'currency_symbol' => $data['currency_symbol'] ?? $totals['currency_symbol'] ?? '$',
            ]);

            foreach ($cartItems as $cartItem) {
                Log::info('Processing cart item', [
                    'cart_item_id' => $cartItem->id,
                    'product_id' => $cartItem->product_id,
                    'service_slot_id' => $cartItem->service_slot_id,
                    'practitioner_offering_slot_id' => $cartItem->practitioner_offering_slot_id,
                    'course_id' => $cartItem->course_id,
                ]);

                if ($cartItem->product_id) {
                    if (! $cartItem->product) {
                        throw new \Exception("Product not found for cart item {$cartItem->id}");
                    }
                    $price = $cartItem->variant ? $cartItem->variant->price : $cartItem->product->price;
                    $productName = $cartItem->product->name ?? $cartItem->product->title;
                    $order->items()->create([
                        'product_id' => $cartItem->product_id,
                        'variant_id' => $cartItem->variant_id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $productName,
                        'type' => 'product',
                    ]);

                } elseif ($cartItem->service_slot_id) {
                    if (! $cartItem->serviceSlot) {
                        throw new \Exception("Service slot not found for cart item {$cartItem->id}");
                    }
                    $price = $cartItem->serviceSlot->price;
                    $serviceName = $cartItem->serviceSlot->name ?? 'Service Appointment';
                    $serviceBooking = ServiceBooking::create([
                        'service_slot_id' => $cartItem->service_slot_id,
                        'user_id' => $userId,
                        'order_id' => $order->id,
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                        'status' => 'confirmed',
                        'total_price' => $price,
                        'notes' => $data['order_notes'] ?? null,
                    ]);
                    $order->items()->create([
                        'service_slot_id' => $cartItem->service_slot_id,
                        'service_booking_id' => $serviceBooking->id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $serviceName,
                        'type' => 'service',
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                    ]);

                } elseif ($cartItem->practitioner_offering_slot_id) {
                    $slot = $cartItem->practitionerOfferingSlot;
                    $offering = $slot?->offering;
                    if (! $slot || ! $offering) {
                        throw new \Exception("Practitioner offering slot not found for cart item {$cartItem->id}");
                    }

                    // ── Double-booking guard ──────────────────────────────
                    $conflict = PractitionerOfferingBooking::where('practitioner_offering_slot_id', $cartItem->practitioner_offering_slot_id)
                        ->where('booking_date', $cartItem->booking_date)
                        ->where('start_time', $cartItem->start_time)
                        ->whereNotIn('status', ['cancelled'])
                        ->exists();
                    if ($conflict) {
                        throw new \Exception("The slot for '{$offering->title}' on {$cartItem->booking_date} at {$cartItem->start_time} has already been booked. Please go back and select a different time.");
                    }

                    $price = $slot->price;
                    $offeringName = $offering->title ?? 'Practitioner Session';
                    try {
                        $practitionerBooking = PractitionerOfferingBooking::create([
                            'practitioner_offering_slot_id' => $cartItem->practitioner_offering_slot_id,
                            'user_id' => $userId,
                            'booking_date' => $cartItem->booking_date,
                            'start_time' => $cartItem->start_time,
                            'end_time' => $cartItem->end_time,
                            'status' => 'confirmed',
                        ]);
                    } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                        throw new \Exception("The slot for '{$offering->title}' was just booked by someone else. Please select a different time.");
                    }

                    $order->items()->create([
                        'practitioner_offering_slot_id' => $cartItem->practitioner_offering_slot_id,
                        'practitioner_offering_booking_id' => $practitionerBooking->id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $offeringName,
                        'type' => 'practitioner_offering',
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                    ]);

                    // ── Course ──────────────────────────────────────────────
                } elseif ($cartItem->course_id) {
                    if (! $cartItem->course) {
                        throw new \Exception("Course not found for cart item {$cartItem->id}");
                    }
                    $originalPrice = (float) ($cartItem->course->price ?? 0);
                    $discountAmt = (float) ($cartItem->course->discount_price ?? 0);
                    $price = max(0, $originalPrice - $discountAmt);  // final amount user pays
                    $courseName = $cartItem->course->title;
                    $order->items()->create([
                        'course_id' => $cartItem->course_id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $courseName,
                        'type' => 'course',
                    ]);

                } else {
                    throw new \Exception("Invalid cart item {$cartItem->id}");
                }
            }

            return $order->load(['items.product', 'items.variant', 'items.serviceSlot', 'address']);
        });
    }

    // ── SINGLE‑ORDER (legacy) ────────────────────────────────────────────

    public function createOrder(?int $userId, ?string $sessionId, array $data, Address $address): Order
    {
        return DB::transaction(function () use ($userId, $sessionId, $data, $address) {
            $cartItems = $this->cartService->getCart($userId, $sessionId);

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            Log::info('Cart items for order creation', [
                'count' => $cartItems->count(),
                'first_item' => $cartItems->first()?->toArray(),
            ]);

            $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $address->id,
                'subtotal' => $totals['subtotal'],
                'shipping' => $totals['shipping'],
                'total' => $totals['total'],
                'status' => 'pending',
                'payment_intent_id' => $data['payment_intent_id'] ?? null,
                'order_notes' => $data['order_notes'] ?? null,
                'currency' => $data['currency'] ?? $totals['currency'] ?? 'USD',
                'currency_symbol' => $data['currency_symbol'] ?? $totals['currency_symbol'] ?? '$',
            ]);

            foreach ($cartItems as $cartItem) {
                Log::info('Processing cart item', [
                    'cart_item_id' => $cartItem->id,
                    'product_id' => $cartItem->product_id,
                    'service_slot_id' => $cartItem->service_slot_id,
                    'practitioner_offering_slot_id' => $cartItem->practitioner_offering_slot_id,
                    'course_id' => $cartItem->course_id,
                ]);

                if ($cartItem->product_id) {
                    if (! $cartItem->product) {
                        throw new \Exception("Product not found for cart item {$cartItem->id}");
                    }
                    $price = $cartItem->variant ? $cartItem->variant->price : $cartItem->product->price;
                    $productName = $cartItem->product->name ?? $cartItem->product->title;
                    $order->items()->create([
                        'product_id' => $cartItem->product_id,
                        'variant_id' => $cartItem->variant_id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $productName,
                        'type' => 'product',
                    ]);

                } elseif ($cartItem->service_slot_id) {
                    if (! $cartItem->serviceSlot) {
                        throw new \Exception("Service slot not found for cart item {$cartItem->id}");
                    }
                    $price = $cartItem->serviceSlot->price;
                    $serviceName = $cartItem->serviceSlot->name ?? 'Service Appointment';
                    $serviceBooking = ServiceBooking::create([
                        'service_slot_id' => $cartItem->service_slot_id,
                        'user_id' => $userId,
                        'order_id' => $order->id,
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                        'status' => 'confirmed',
                        'total_price' => $price,
                        'notes' => $data['order_notes'] ?? null,
                    ]);
                    $order->items()->create([
                        'service_slot_id' => $cartItem->service_slot_id,
                        'service_booking_id' => $serviceBooking->id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $serviceName,
                        'type' => 'service',
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                    ]);

                } elseif ($cartItem->practitioner_offering_slot_id) {
                    $slot = $cartItem->practitionerOfferingSlot;
                    $offering = $slot?->offering;
                    if (! $slot || ! $offering) {
                        throw new \Exception("Practitioner offering slot not found for cart item {$cartItem->id}");
                    }

                    // ── Double-booking guard ──────────────────────────────
                    $conflict = PractitionerOfferingBooking::where('practitioner_offering_slot_id', $cartItem->practitioner_offering_slot_id)
                        ->where('booking_date', $cartItem->booking_date)
                        ->where('start_time', $cartItem->start_time)
                        ->whereNotIn('status', ['cancelled'])
                        ->exists();
                    if ($conflict) {
                        throw new \Exception("The slot for '{$offering->title}' on {$cartItem->booking_date} at {$cartItem->start_time} has already been booked. Please go back and select a different time.");
                    }

                    $price = $slot->price;
                    $offeringName = $offering->title ?? 'Practitioner Session';
                    try {
                        $practitionerBooking = PractitionerOfferingBooking::create([
                            'practitioner_offering_slot_id' => $cartItem->practitioner_offering_slot_id,
                            'user_id' => $userId,
                            'booking_date' => $cartItem->booking_date,
                            'start_time' => $cartItem->start_time,
                            'end_time' => $cartItem->end_time,
                            'status' => 'confirmed',
                        ]);
                    } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                        throw new \Exception("The slot for '{$offering->title}' was just booked by someone else. Please select a different time.");
                    }

                    $order->items()->create([
                        'practitioner_offering_slot_id' => $cartItem->practitioner_offering_slot_id,
                        'practitioner_offering_booking_id' => $practitionerBooking->id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $offeringName,
                        'type' => 'practitioner_offering',
                        'booking_date' => $cartItem->booking_date,
                        'start_time' => $cartItem->start_time,
                        'end_time' => $cartItem->end_time,
                    ]);

                    // ── Course ──────────────────────────────────────────────
                } elseif ($cartItem->course_id) {
                    if (! $cartItem->course) {
                        throw new \Exception("Course not found for cart item {$cartItem->id}");
                    }
                    $originalPrice = (float) ($cartItem->course->price ?? 0);
                    $discountAmt = (float) ($cartItem->course->discount_price ?? 0);
                    $price = max(0, $originalPrice - $discountAmt);  // final amount user pays
                    $courseName = $cartItem->course->title;
                    $order->items()->create([
                        'course_id' => $cartItem->course_id,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $price,
                        'subtotal' => $price * $cartItem->quantity,
                        'product_name' => $courseName,
                        'type' => 'course',
                    ]);

                } else {
                    throw new \Exception("Invalid cart item {$cartItem->id}");
                }
            }

            return $order->load(['items.product', 'items.variant', 'items.serviceSlot', 'address']);
        });
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MARK ORDER AS PAID + ENROL IN COURSES
    // ─────────────────────────────────────────────────────────────────────────

    public function markOrderAsPaid(Order $order, string $paymentIntentId): Order
    {
        $order->update([
            'status' => 'paid',
            'payment_intent_id' => $paymentIntentId,
            'paid_at' => now(),
        ]);

        // Confirm service bookings
        $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
            if ($item->serviceBooking) {
                $item->serviceBooking->update(['status' => 'confirmed']);
            }
        });

        // Confirm practitioner bookings
        $order->items()->whereNotNull('practitioner_offering_booking_id')->each(function ($item) {
            if ($item->practitionerOfferingBooking) {
                $item->practitionerOfferingBooking->update(['status' => 'confirmed']);
            }
        });

        // ── Enrol user in each course from this order ────────────────
        $order->items()->whereNotNull('course_id')->each(function ($item) use ($order) {
            $course = Course::find($item->course_id);
            if ($course && $order->user_id) {
                $alreadyEnrolled = $course->enrollments()
                    ->where('user_id', $order->user_id)
                    ->exists();
                if (! $alreadyEnrolled) {
                    $course->enrollments()->create([
                        'user_id' => $order->user_id,
                        'status' => 'active',
                    ]);
                }
            }
        });

        return $order->fresh();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // CANCELLATION / REFUND
    // ─────────────────────────────────────────────────────────────────────────

    public function cancelOrder(Order $order, ?string $reason = null): Order
    {
        return DB::transaction(function () use ($order, $reason) {
            if ($order->canCancelImmediately()) {
                return $this->processImmediateCancellation($order, $reason);
            }
            if ($order->canRequestCancellation()) {
                return $this->requestCancellation($order, $reason);
            }
            throw new \Exception('Order cannot be cancelled at this time');
        });
    }

    protected function processImmediateCancellation(Order $order, ?string $reason): Order
    {
        $this->processRefund($order);

        $order->update([
            'status' => 'cancelled',
            'cancellation_type' => 'immediate',
            'cancelled_by' => 'user',
            'cancellation_reason' => $reason,
            'cancellation_requested_at' => now(),
        ]);

        // Cancel service bookings
        $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
            if ($item->serviceBooking) {
                $item->serviceBooking->update(['status' => 'cancelled']);
            }
        });

        // Cancel practitioner bookings
        $order->items()->whereNotNull('practitioner_offering_booking_id')->each(function ($item) {
            if ($item->practitionerOfferingBooking) {
                $item->practitionerOfferingBooking->update(['status' => 'cancelled']);
            }
        });

        // Unenrol from courses
        $order->items()->whereNotNull('course_id')->each(function ($item) use ($order) {
            CourseEnrollment::where('course_id', $item->course_id)
                ->where('user_id', $order->user_id)
                ->delete();
        });

        $this->restoreProductStock($order);
        $this->notifyVendorsOfCancellation($order);

        return $order->fresh();
    }

    protected function requestCancellation(Order $order, ?string $reason): Order
    {
        $order->update([
            'status' => 'cancellation_requested',
            'cancellation_type' => 'requested',
            'cancellation_reason' => $reason,
            'cancellation_requested_at' => now(),
        ]);

        $this->notifyVendorsOfCancellationRequest($order);

        return $order->fresh();
    }

    public function approveCancellation(Order $order, int $vendorId): Order
    {
        if ($order->status !== 'cancellation_requested') {
            throw new \Exception('No pending cancellation request for this order');
        }

        return DB::transaction(function () use ($order) {
            $this->processRefund($order);

            $order->update([
                'status' => 'cancelled',
                'cancelled_by' => 'vendor',
            ]);

            // Cancel bookings
            $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
                if ($item->serviceBooking) {
                    $item->serviceBooking->update(['status' => 'cancelled']);
                }
            });

            $order->items()->whereNotNull('practitioner_offering_booking_id')->each(function ($item) {
                if ($item->practitionerOfferingBooking) {
                    $item->practitionerOfferingBooking->update(['status' => 'cancelled']);
                }
            });

            // Unenrol from courses
            $order->items()->whereNotNull('course_id')->each(function ($item) use ($order) {
                CourseEnrollment::where('course_id', $item->course_id)
                    ->where('user_id', $order->user_id)
                    ->delete();
            });

            $this->restoreProductStock($order);
            $this->notifyVendorsOfCancellation($order);

            return $order->fresh();
        });
    }

    public function denyCancellation(Order $order, int $vendorId, ?string $reason = null): Order
    {
        if ($order->status !== 'cancellation_requested') {
            throw new \Exception('No pending cancellation request for this order');
        }

        $order->update([
            'status' => 'paid',
            'cancellation_requested_at' => null,
            'cancellation_reason' => null,
            'cancellation_type' => null,
        ]);

        return $order->fresh();
    }

    public function vendorCancelOrder(Order $order, int $vendorId, string $reason): Order
    {
        $hasVendorProducts = $order->items()
            ->where(function ($q) use ($vendorId) {
                $q->whereHas('product', function ($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                    ->orWhereHas('serviceSlot.product', function ($query) use ($vendorId) {
                        $query->where('vendor_id', $vendorId);
                    });
            })
            ->exists();

        if (! $hasVendorProducts) {
            throw new \Exception('You do not have permission to cancel this order');
        }

        return DB::transaction(function () use ($order, $reason) {
            $this->processRefund($order);

            $order->update([
                'status' => 'cancelled',
                'cancellation_type' => 'vendor_initiated',
                'cancelled_by' => 'vendor',
                'cancellation_reason' => $reason,
                'cancellation_requested_at' => now(),
            ]);

            $order->items()->whereNotNull('service_booking_id')->each(function ($item) {
                if ($item->serviceBooking) {
                    $item->serviceBooking->update(['status' => 'cancelled']);
                }
            });

            $order->items()->whereNotNull('practitioner_offering_booking_id')->each(function ($item) {
                if ($item->practitionerOfferingBooking) {
                    $item->practitionerOfferingBooking->update(['status' => 'cancelled']);
                }
            });

            // Unenrol from courses
            $order->items()->whereNotNull('course_id')->each(function ($item) use ($order) {
                CourseEnrollment::where('course_id', $item->course_id)
                    ->where('user_id', $order->user_id)
                    ->delete();
            });

            $this->restoreProductStock($order);
            $this->notifyVendorsOfCancellation($order);

            return $order->fresh();
        });
    }

    // ─────────────────────────────────────────────────────────────────────────
    // REFUND & STOCK HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    protected function processRefund(Order $order): void
    {
        if (! $order->payment_intent_id) {
            Log::warning("Order {$order->id} has no payment intent ID, skipping refund");

            return;
        }

        try {
            $refund = $this->paymentService->refundPayment(
                $order->payment_intent_id,
                $order->total,
                $order->currency
            );

            $order->update([
                'refund_id' => $refund['refund_id'],
                'refund_status' => $refund['status'],
                'refunded_at' => now(),
                'refund_amount' => $refund['amount'],
            ]);

            Log::info("Refund processed for order {$order->id}", [
                'refund_id' => $refund['refund_id'],
                'amount' => $refund['amount'],
                'currency' => $refund['currency'],
            ]);

        } catch (\Exception $e) {
            Log::error("Refund failed for order {$order->id}: ".$e->getMessage());
            throw new \Exception('Failed to process refund: '.$e->getMessage());
        }
    }

    protected function restoreProductStock(Order $order): void
    {
        $order->items()->whereNotNull('variant_id')->each(function ($item) {
            if ($item->variant && $item->variant->stock !== null) {
                $item->variant->increment('stock', $item->quantity);
            }
        });
    }

    // ─────────────────────────────────────────────────────────────────────────
    // NOTIFICATION HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    protected function notifyVendorsOfCancellation(Order $order): void
    {
        $vendorIds = $order->getVendorIds();
        foreach ($vendorIds as $vendorId) {
            $vendor = \App\Models\Vendor::find($vendorId);
            if ($vendor && $vendor->user) {
                // $vendor->user->notify(new VendorOrderCancelledNotification($order));
            }
        }
    }

    protected function notifyVendorsOfCancellationRequest(Order $order): void
    {
        $vendorIds = $order->getVendorIds();
        foreach ($vendorIds as $vendorId) {
            $vendor = \App\Models\Vendor::find($vendorId);
            if ($vendor && $vendor->user) {
                // $vendor->user->notify(new OrderCancellationRequestNotification($order));
            }
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // OTHER PUBLIC METHODS (unchanged)
    // ─────────────────────────────────────────────────────────────────────────

    public function getUserOrders(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Order::where('user_id', $userId)
            ->with(['items.product', 'items.variant', 'items.serviceSlot', 'address'])
            ->latest()
            ->paginate($perPage);
    }

    public function getOrderDetails(Order $order): Order
    {
        return $order->load([
            'items.product.vendor',
            'items.variant',
            'items.serviceSlot',
            'address',
        ]);
    }

    public function updateOrderStatus(Order $order, string $status, ?int $vendorId = null): Order
    {
        $validStatuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (! in_array($status, $validStatuses)) {
            throw new \Exception('Invalid order status');
        }

        if ($status === 'cancelled' && $vendorId && $order->status === 'cancellation_requested') {
            return $this->approveCancellation($order, $vendorId);
        }

        $order->update(['status' => $status]);

        return $order->fresh();
    }

    public function getVendorOrders(int $vendorId, ?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Order::where(function ($q) use ($vendorId) {
            $q->whereHas('items.product', function ($productQuery) use ($vendorId) {
                $productQuery->where('vendor_id', $vendorId);
            })
                ->orWhereHas('items.serviceSlot', function ($serviceQuery) use ($vendorId) {
                    $serviceQuery->whereHas('product', function ($productQuery) use ($vendorId) {
                        $productQuery->where('vendor_id', $vendorId);
                    });
                });
        })
            ->with([
                'items.product',
                'items.variant',
                'items.serviceSlot.product',
                'address',
                'user',
            ]);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->latest()->paginate($perPage);
    }
}

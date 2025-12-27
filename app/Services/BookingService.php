<?php

namespace App\Services;

use App\Models\ServiceBooking;
use App\Models\ServiceSlot;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function getAvailability(ServiceSlot $slot, string $startDate, string $endDate): array
    {
        $bookings = ServiceBooking::where('service_slot_id', $slot->id)
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        $availability = [];
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        while ($start->lte($end)) {
            $dateBookings = $bookings->where('booking_date', $start->toDateString());
            
            $availability[$start->toDateString()] = [
                'date' => $start->toDateString(),
                'booked_slots' => $dateBookings->map(function ($booking) {
                    return [
                        'start_time' => $booking->start_time,
                        'end_time' => $booking->end_time,
                    ];
                })->toArray(),
            ];

            $start->addDay();
        }

        return $availability;
    }

    public function createBooking(int $userId, array $data): ServiceBooking
    {
        return DB::transaction(function () use ($userId, $data) {
            $hasOverlap = $this->checkTimeOverlap(
                $data['service_slot_id'],
                $data['booking_date'],
                $data['start_time'],
                $data['end_time']
            );

            if ($hasOverlap) {
                throw new \Exception('Time slot is already booked');
            }

            $data['user_id'] = $userId;
            return ServiceBooking::create($data);
        });
    }

    public function cancelBooking(ServiceBooking $booking): ServiceBooking
    {
        DB::transaction(function () use ($booking) {
            $booking->update(['status' => 'cancelled']);
        });

        return $booking->fresh();
    }

    public function getUserBookings(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return ServiceBooking::where('user_id', $userId)
            ->with(['serviceSlot.product.vendor'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate($perPage);
    }

    public function getVendorBookings(int $vendorId, int $perPage = 15): LengthAwarePaginator
    {
        return ServiceBooking::whereHas('serviceSlot.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->with(['serviceSlot.product', 'user'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate($perPage);
    }

    protected function checkTimeOverlap(int $slotId, string $date, string $startTime, string $endTime): bool
    {
        return ServiceBooking::where('service_slot_id', $slotId)
            ->where('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $startTime)
                          ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();
    }
}
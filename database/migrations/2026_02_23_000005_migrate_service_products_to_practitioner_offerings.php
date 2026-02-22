<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up(): void
    {
        $serviceProducts = DB::table('products')->where('type', 'service')->get();

        foreach ($serviceProducts as $product) {
            $vendor = DB::table('vendors')->find($product->vendor_id);
            if (! $vendor) continue;

            $profile = DB::table('practitioner_profiles')
                ->where('user_id', $vendor->user_id)
                ->first();

            if (! $profile) {
                Log::warning("Cannot migrate service product ID {$product->id}: vendor user_id {$vendor->user_id} has no practitioner profile.");
                continue;
            }

            $slots = DB::table('service_slots')->where('product_id', $product->id)->get();

            foreach ($slots as $slot) {
                $offeringId = DB::table('practitioner_offerings')->insertGetId([
                    'practitioner_profile_id' => $profile->id,
                    'subcategory_id'          => null, // Must be set manually post-migration
                    'title'                   => $product->title,
                    'brief'                   => $product->brief,
                    'description'             => $product->description,
                    'duration'                => $slot->duration,
                    'price'                   => $slot->price,
                    'active'                  => $product->active,
                    'images'                  => $product->images,
                    'created_at'              => $product->created_at,
                    'updated_at'              => $product->updated_at,
                ]);

                $offeringSlotId = DB::table('practitioner_offering_slots')->insertGetId([
                    'practitioner_offering_id' => $offeringId,
                    'duration'                 => $slot->duration,
                    'price'                    => $slot->price,
                    'created_at'               => $slot->created_at,
                    'updated_at'               => $slot->updated_at,
                ]);

                // Migrate availability
                DB::table('service_availability')
                    ->where('service_slot_id', $slot->id)
                    ->get()
                    ->each(fn ($a) => DB::table('practitioner_offering_availability')->insert([
                        'practitioner_offering_slot_id' => $offeringSlotId,
                        'day_of_week'                   => $a->day_of_week,
                        'start_time'                    => $a->start_time,
                        'end_time'                      => $a->end_time,
                        'created_at'                    => $a->created_at,
                        'updated_at'                    => $a->updated_at,
                    ]));

                // Migrate bookings
                DB::table('service_bookings')
                    ->where('service_slot_id', $slot->id)
                    ->get()
                    ->each(fn ($b) => DB::table('practitioner_offering_bookings')->insert([
                        'practitioner_offering_slot_id' => $offeringSlotId,
                        'user_id'                       => $b->user_id,
                        'booking_date'                  => $b->booking_date,
                        'start_time'                    => $b->start_time,
                        'end_time'                      => $b->end_time,
                        'status'                        => $b->status,
                        'created_at'                    => $b->created_at,
                        'updated_at'                    => $b->updated_at,
                    ]));

                DB::table('service_bookings')->where('service_slot_id', $slot->id)->delete();
                DB::table('service_availability')->where('service_slot_id', $slot->id)->delete();
                DB::table('service_slots')->where('id', $slot->id)->delete();
            }

            DB::table('products')->where('id', $product->id)->delete();
        }
    }

    public function down(): void
    {
        // Intentional no-op
    }
};

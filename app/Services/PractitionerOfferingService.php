<?php

namespace App\Services;

use App\Models\PractitionerOffering;
use App\Models\PractitionerProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PractitionerOfferingService
{
    public function createOffering(PractitionerProfile $profile, array $data): PractitionerOffering
    {
        return DB::transaction(function () use ($profile, $data) {
            $imagePaths = $this->storeImages($data['images'] ?? []);

            $offering = PractitionerOffering::create([
                'practitioner_profile_id' => $profile->id,
                'subcategory_id'          => $data['subcategory_id'],
                'title'                   => $data['title'],
                'brief'                   => $data['brief'],
                'description'             => $data['description'],
                'duration'                => $data['duration'],
                'price'                   => $data['price'],
                'active'                  => $data['active'] ?? true,
                'images'                  => $imagePaths,
            ]);

            // Create a default slot using the offering's own duration/price
            $offering->slots()->create([
                'duration' => $data['duration'],
                'price'    => $data['price'],
            ]);

            return $offering->load(['subcategory', 'slots', 'slots.availability']);
        });
    }

    public function updateOffering(PractitionerOffering $offering, array $data): PractitionerOffering
    {
        return DB::transaction(function () use ($offering, $data) {
            if (isset($data['images'])) {
                $newPaths = $this->storeImages($data['images']);
                if (! empty($newPaths) && $offering->images) {
                    foreach ($offering->images as $url) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', parse_url($url, PHP_URL_PATH)));
                    }
                }
                $data['images'] = $newPaths;
            }

            $offering->update(array_intersect_key($data, array_flip($offering->getFillable())));

            return $offering->fresh(['subcategory', 'slots', 'slots.availability']);
        });
    }

    public function deleteOffering(PractitionerOffering $offering): bool
    {
        return DB::transaction(function () use ($offering) {
            if ($offering->images) {
                foreach ($offering->images as $url) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', parse_url($url, PHP_URL_PATH)));
                }
            }
            return $offering->delete();
        });
    }

    public function getOfferingWithDetails(int $id): ?PractitionerOffering
    {
        return PractitionerOffering::with([
            'practitionerProfile.user', 'subcategory', 'slots', 'slots.availability',
        ])->find($id);
    }

    public function getProfileOfferings(int $profileId, int $perPage = 15): LengthAwarePaginator
    {
        return PractitionerOffering::where('practitioner_profile_id', $profileId)
            ->with(['subcategory', 'slots', 'slots.availability'])
            ->latest()
            ->paginate($perPage);
    }

    public function getOfferingsBySubcategory(int $subcategoryId, int $perPage = 15): LengthAwarePaginator
    {
        return PractitionerOffering::where('subcategory_id', $subcategoryId)
            ->where('active', true)
            ->with(['practitionerProfile', 'subcategory', 'slots'])
            ->latest()
            ->paginate($perPage);
    }

    private function storeImages(array $images): array
    {
        $paths = [];
        foreach ($images as $image) {
            if ($image instanceof \Illuminate\Http\UploadedFile) {
                $paths[] = Storage::url($image->store('practitioner_offerings', 'public'));
            }
        }
        return $paths;
    }
}

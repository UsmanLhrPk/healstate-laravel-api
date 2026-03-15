<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practitioners\StorePractitionerOfferingRequest;
use App\Http\Requests\Practitioners\UpdatePractitionerOfferingRequest;
use App\Http\Resources\Practitioners\PractitionerOfferingResource;
use App\Models\PractitionerOffering;
use App\Models\PractitionerProfile;
use App\Services\PractitionerOfferingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Practitioner Offerings
 */
class PractitionerOfferingController extends Controller
{
    public function __construct(protected PractitionerOfferingService $offeringService) {}

    /**
     * Browse All Offerings — Public Marketplace
     *
     * Returns active offerings across ALL practitioners.
     * Used by the public /services browse page. No authentication required.
     *
     * Route: GET /practitioners/offerings/browse
     */
    public function browse(Request $request): JsonResponse
    {
        $query = PractitionerOffering::with(['practitioner.user', 'subcategory', 'slots.availability'])
            ->where('active', true);

        if ($request->filled('category_id')) {
            $query->whereHas('subcategory', fn ($q) =>
                $q->where('category_id', $request->category_id)
            );
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        match ($request->get('sort', 'latest')) {
            'price_low'  => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            default      => $query->latest(),
        };

        return response()->json(
            $query->paginate($request->get('per_page', 12))
        );
    }

    /**
     * List Own Offerings — Practitioner Dashboard
     *
     * Returns ALL offerings (active + inactive) belonging to the authenticated
     * practitioner only. Requires authentication.
     *
     * Route: GET /practitioners/offerings/all  (auth:sanctum)
     */
    public function index(Request $request): JsonResponse
    {
        $practitionerProfile = PractitionerProfile::where('user_id', $request->user()->id)->first();

        if (! $practitionerProfile) {
            return response()->json(['message' => 'No practitioner profile found for this user.'], 403);
        }

        $query = PractitionerOffering::with(['practitioner.user', 'subcategory', 'slots.availability'])
            ->where('practitioner_profile_id', $practitionerProfile->id); // strictly own offerings

        if ($request->filled('category_id')) {
            $query->whereHas('subcategory', fn ($q) =>
                $q->where('category_id', $request->category_id)
            );
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        match ($request->get('sort', 'latest')) {
            'price_low'  => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            default      => $query->latest(),
        };

        return response()->json(
            $query->paginate($request->get('per_page', 12))
        );
    }

    /**
     * List Profile Offerings — Public
     *
     * Returns active offerings for a specific practitioner profile.
     * Used by the public practitioner profile page.
     *
     * Route: GET /practitioners/profiles/{profile}/offerings
     */
    public function profileOfferings(Request $request, PractitionerProfile $profile): JsonResponse
    {
        $offerings = PractitionerOffering::with(['practitioner.user', 'subcategory', 'slots.availability'])
            ->where('practitioner_profile_id', $profile->id)
            ->where('active', true)
            ->latest()
            ->paginate($request->get('per_page', 12));

        return response()->json($offerings);
    }

    /**
     * List Offerings by Subcategory — Public
     *
     * Route: GET /practitioners/offerings?subcategory_id=X
     */
    public function bySubcategory(Request $request): JsonResponse
    {
        $request->validate(['subcategory_id' => 'required|exists:service_subcategories,id']);
        $perPage   = min($request->input('per_page', 15), 100);
        $offerings = $this->offeringService->getOfferingsBySubcategory($request->subcategory_id, $perPage);
        return response()->json($offerings);
    }

    /**
     * Get Offering Details — Public
     *
     * Route: GET /practitioners/offerings/{offering}
     */
    public function show(PractitionerOffering $offering): JsonResponse
    {
        $offering = $this->offeringService->getOfferingWithDetails($offering->id);
        return response()->json(['data' => new PractitionerOfferingResource($offering)]);
    }

    /**
     * Create Offering
     *
     * Route: POST /practitioners/profiles/{profile}/offerings  (auth:sanctum)
     */
    public function store(StorePractitionerOfferingRequest $request, PractitionerProfile $profile): JsonResponse
    {
        if ($profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $offering = $this->offeringService->createOffering($profile, $request->validated());

        return response()->json([
            'message' => 'Offering created successfully',
            'data'    => new PractitionerOfferingResource($offering),
        ], 201);
    }

    /**
     * Update Offering
     *
     * Route: PUT /practitioners/offerings/{offering}  (auth:sanctum)
     */
    public function update(UpdatePractitionerOfferingRequest $request, PractitionerOffering $offering): JsonResponse
    {
        $practitionerProfile = PractitionerProfile::where('user_id', $request->user()->id)->first();

        if (! $practitionerProfile || $offering->practitioner_profile_id !== $practitionerProfile->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $offering = $this->offeringService->updateOffering($offering, $request->validated());

        return response()->json([
            'message' => 'Offering updated successfully',
            'data'    => new PractitionerOfferingResource($offering),
        ]);
    }

    /**
     * Delete Offering
     *
     * Route: DELETE /practitioners/offerings/{offering}  (auth:sanctum)
     */
    public function destroy(PractitionerOffering $offering): JsonResponse
    {
        $this->authorize('delete', $offering);
        $this->offeringService->deleteOffering($offering);
        return response()->json(['message' => 'Offering deleted successfully']);
    }
}
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
 *
 * APIs for managing practitioner service offerings.
 * Offerings represent the services a practitioner provides (e.g. sessions, consultations).
 * Physical products are managed separately under Vendor Products.
 */
class PractitionerOfferingController extends Controller
{
    public function __construct(protected PractitionerOfferingService $offeringService) {}

    /**
     * List Practitioner Offerings
     *
     * Get all service offerings for a specific practitioner profile with pagination.
     * Public endpoint, no authentication required.
     *
     * @urlParam profile integer required The practitioner profile ID. Example: 1
     *
     * @queryParam page integer Page number. Example: 1
     * @queryParam per_page integer Items per page (max 100). Example: 15
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "profile_id": 1,
     *       "title": "60-Minute Deep Tissue Massage",
     *       "description": "Full body deep tissue massage session.",
     *       "price": "120.00",
     *       "duration_minutes": 60,
     *       "active": true,
     *       "subcategory": {
     *         "id": 2,
     *         "name": "Massage Therapy"
     *       }
     *     }
     *   ],
     *   "links": {
     *     "first": "http://localhost/api/practitioners/profiles/1/offerings?page=1",
     *     "last": "http://localhost/api/practitioners/profiles/1/offerings?page=2",
     *     "prev": null,
     *     "next": "http://localhost/api/practitioners/profiles/1/offerings?page=2"
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 2,
     *     "per_page": 15,
     *     "to": 15,
     *     "total": 20
     *   }
     * }
     */
    public function index(Request $request)
{
    $query = PractitionerOffering::with(['practitioner.user', 'subcategory', 'slots.availability'])
        ->where('active', true);

    if ($request->filled('category_id')) {
        $query->whereHas('subcategory', fn($q) =>
            $q->where('category_id', $request->category_id)
        );
    }

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $sort = $request->get('sort', 'latest');
    match($sort) {
        'price_low'  => $query->orderBy('price', 'asc'),
        'price_high' => $query->orderBy('price', 'desc'),
        default      => $query->latest(),
    };

    return response()->json($query->paginate($request->get('per_page', 12)));
}

    /**
     * List Offerings by Subcategory
     *
     * Retrieve all active practitioner offerings belonging to a specific service subcategory.
     * Useful for browsing services by type (e.g. all massage therapy offerings).
     * Public endpoint, no authentication required.
     *
     * @queryParam subcategory_id integer required The service subcategory ID. Example: 2
     * @queryParam per_page integer Items per page (max 100). Example: 15
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "60-Minute Deep Tissue Massage",
     *       "price": "120.00",
     *       "duration_minutes": 60,
     *       "practitioner": {
     *         "id": 1,
     *         "professional_title": "Licensed Massage Therapist",
     *         "user": { "id": 123, "name": "Jane Smith" }
     *       }
     *     }
     *   ]
     * }
     *
     * @response 422 {
     *   "message": "The subcategory id field is required.",
     *   "errors": {
     *     "subcategory_id": ["The subcategory id field is required."]
     *   }
     * }
     */
    public function bySubcategory(Request $request): JsonResponse
    {
        $request->validate(['subcategory_id' => 'required|exists:service_subcategories,id']);
        $perPage  = min($request->input('per_page', 15), 100);
        $offerings = $this->offeringService->getOfferingsBySubcategory($request->subcategory_id, $perPage);
        return response()->json($offerings);
    }

    /**
     * Create Offering
     *
     * Create a new service offering under a practitioner profile.
     * Only the practitioner who owns the profile can create offerings.
     *
     * @authenticated
     *
     * @urlParam profile integer required The practitioner profile ID. Example: 1
     *
     * @bodyParam title string required Offering title. Example: 60-Minute Deep Tissue Massage
     * @bodyParam description string required Detailed description of the service. Example: Full body deep tissue massage targeting chronic pain...
     * @bodyParam price numeric required Price for the offering. Example: 120.00
     * @bodyParam duration_minutes integer required Duration of the session in minutes. Example: 60
     * @bodyParam subcategory_id integer required The service subcategory ID. Example: 2
     * @bodyParam active boolean optional Whether the offering is active. Example: true
     *
     * @response 201 {
     *   "message": "Offering created successfully",
     *   "data": {
     *     "id": 1,
     *     "profile_id": 1,
     *     "title": "60-Minute Deep Tissue Massage",
     *     "description": "Full body deep tissue massage targeting chronic pain...",
     *     "price": "120.00",
     *     "duration_minutes": 60,
     *     "active": true,
     *     "subcategory": {
     *       "id": 2,
     *       "name": "Massage Therapy"
     *     },
     *     "created_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * }
     *
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function store(StorePractitionerOfferingRequest $request, PractitionerProfile $profile): JsonResponse
    {
        $offering = $this->offeringService->createOffering($profile, $request->validated());
        return response()->json([
            'message' => 'Offering created successfully',
            'data'    => new PractitionerOfferingResource($offering),
        ], 201);
    }

    /**
     * Get Offering Details
     *
     * Retrieve detailed information about a specific practitioner offering,
     * including available slots and booking options.
     * Public endpoint, no authentication required.
     *
     * @urlParam offering integer required The offering ID. Example: 1
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "profile_id": 1,
     *     "title": "60-Minute Deep Tissue Massage",
     *     "description": "Full body deep tissue massage targeting chronic pain...",
     *     "price": "120.00",
     *     "duration_minutes": 60,
     *     "active": true,
     *     "subcategory": {
     *       "id": 2,
     *       "name": "Massage Therapy"
     *     },
     *     "practitioner": {
     *       "id": 1,
     *       "professional_title": "Licensed Massage Therapist",
     *       "user": { "id": 123, "name": "Jane Smith" }
     *     },
     *     "slots": [
     *       {
     *         "id": 1,
     *         "day_of_week": "monday",
     *         "start_time": "09:00",
     *         "end_time": "10:00"
     *       }
     *     ]
     *   }
     * }
     */
    public function show(PractitionerOffering $offering): JsonResponse
    {
        $offering = $this->offeringService->getOfferingWithDetails($offering->id);
        return response()->json(['data' => new PractitionerOfferingResource($offering)]);
    }

    /**
     * Update Offering
     *
     * Update a practitioner service offering.
     * Only the practitioner who owns the offering can update it.
     *
     * @authenticated
     *
     * @urlParam offering integer required The offering ID. Example: 1
     *
     * @bodyParam title string optional Offering title. Example: 90-Minute Deep Tissue Massage
     * @bodyParam description string optional Detailed description. Example: Extended session for full body treatment...
     * @bodyParam price numeric optional Price for the offering. Example: 160.00
     * @bodyParam duration_minutes integer optional Duration in minutes. Example: 90
     * @bodyParam subcategory_id integer optional The service subcategory ID. Example: 2
     * @bodyParam active boolean optional Active status. Example: false
     *
     * @response 200 {
     *   "message": "Offering updated successfully",
     *   "data": {
     *     "id": 1,
     *     "title": "90-Minute Deep Tissue Massage",
     *     "price": "160.00",
     *     "duration_minutes": 90,
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     *
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function update(UpdatePractitionerOfferingRequest $request, PractitionerOffering $offering): JsonResponse
    {
        $offering = $this->offeringService->updateOffering($offering, $request->validated());
        return response()->json([
            'message' => 'Offering updated successfully',
            'data'    => new PractitionerOfferingResource($offering),
        ]);
    }

    /**
     * Delete Offering
     *
     * Delete a practitioner service offering.
     * Only the practitioner who owns the offering can delete it.
     *
     * @authenticated
     *
     * @urlParam offering integer required The offering ID. Example: 1
     *
     * @response 200 {
     *   "message": "Offering deleted successfully"
     * }
     *
     * @response 403 {
     *   "message": "Unauthorized"
     * }
     */
    public function destroy(PractitionerOffering $offering): JsonResponse
    {
        $this->authorize('delete', $offering);
        $this->offeringService->deleteOffering($offering);
        return response()->json(['message' => 'Offering deleted successfully']);
    }
}
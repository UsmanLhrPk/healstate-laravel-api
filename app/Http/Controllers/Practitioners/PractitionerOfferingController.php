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

class PractitionerOfferingController extends Controller
{
    public function __construct(protected PractitionerOfferingService $offeringService) {}

    public function index(Request $request, PractitionerProfile $profile): JsonResponse
    {
        $perPage  = min($request->input('per_page', 15), 100);
        $offerings = $this->offeringService->getProfileOfferings($profile->id, $perPage);
        return response()->json($offerings);
    }

    public function bySubcategory(Request $request): JsonResponse
    {
        $request->validate(['subcategory_id' => 'required|exists:service_subcategories,id']);
        $perPage  = min($request->input('per_page', 15), 100);
        $offerings = $this->offeringService->getOfferingsBySubcategory($request->subcategory_id, $perPage);
        return response()->json($offerings);
    }

    public function store(StorePractitionerOfferingRequest $request, PractitionerProfile $profile): JsonResponse
    {
        $offering = $this->offeringService->createOffering($profile, $request->validated());
        return response()->json([
            'message' => 'Offering created successfully',
            'data'    => new PractitionerOfferingResource($offering),
        ], 201);
    }

    public function show(PractitionerOffering $offering): JsonResponse
    {
        $offering = $this->offeringService->getOfferingWithDetails($offering->id);
        return response()->json(['data' => new PractitionerOfferingResource($offering)]);
    }

    public function update(UpdatePractitionerOfferingRequest $request, PractitionerOffering $offering): JsonResponse
    {
        $offering = $this->offeringService->updateOffering($offering, $request->validated());
        return response()->json([
            'message' => 'Offering updated successfully',
            'data'    => new PractitionerOfferingResource($offering),
        ]);
    }

    public function destroy(PractitionerOffering $offering): JsonResponse
    {
        $this->authorize('delete', $offering);
        $this->offeringService->deleteOffering($offering);
        return response()->json(['message' => 'Offering deleted successfully']);
    }
}

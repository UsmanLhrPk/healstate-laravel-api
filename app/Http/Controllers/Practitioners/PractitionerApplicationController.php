<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practitioners\ReviewApplicationRequest;
use App\Http\Requests\Practitioners\StorePractitionerApplicationRequest;
use App\Http\Resources\Practitioners\PractitionerApplicationResource;
use App\Services\PractitionerApplicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Practitioner Applications
 * 
 * APIs for managing practitioner/healer applications
 */
class PractitionerApplicationController extends Controller
{
    public function __construct(
        protected PractitionerApplicationService $applicationService
    ) {}

    /**
     * Submit Practitioner Application
     * 
     * Submit a new application to become a practitioner on the platform.
     * Users can upload up to 5 credential documents (PDF/JPG, max 5MB each).
     * Only one pending application is allowed per user.
     * 
     * @authenticated
     * 
     * @bodyParam phone_number string required The practitioner's phone number. Example: +1234567890
     * @bodyParam professional_title string required Professional title or credentials. Example: Licensed Massage Therapist
     * @bodyParam years_experience string required Years of experience. Example: 5-10
     * @bodyParam bio string required Bio/About me (max 500 characters). Example: Experienced massage therapist specializing in...
     * @bodyParam license_number string optional License or certification number. Example: LMT123456
     * @bodyParam issuing_organization string optional Issuing organization name. Example: State Board of Massage
     * @bodyParam credentials array required Array of credential files (1-5 files). Example: [{"file": "...", "document_type": "license"}]
     * @bodyParam credentials.*.file file required Credential document file (PDF/JPG/PNG, max 5MB).
     * @bodyParam credentials.*.document_type string required Type of document. Example: license
     * @bodyParam primary_category_id integer required Primary service category ID. Example: 1
     * @bodyParam service_subcategories array required Array of service subcategory IDs. Example: [1, 2, 3]
     * @bodyParam service_description string required Description of services offered (max 1000 characters). Example: I specialize in deep tissue massage...
     * @bodyParam availability_schedule object required Weekly availability schedule. Example: {"monday": {"morning": true, "afternoon": false, "evening": true}}
     * @bodyParam timezone string required Timezone. Example: America/New_York
     * @bodyParam terms_agreed boolean required Must agree to terms of service. Example: true
     * 
     * @response 201 {
     *   "success": true,
     *   "message": "Application submitted successfully. We will review within 3-5 business days.",
     *   "data": {
     *     "id": 1,
     *     "user_id": 123,
     *     "status": "pending",
     *     "professional_title": "Licensed Massage Therapist",
     *     "submitted_at": "2024-02-08T14:30:00Z"
     *   }
     * }
     * 
     * @response 422 {
     *   "success": false,
     *   "message": "Validation failed",
     *   "errors": {
     *     "bio": ["The bio must not exceed 500 characters."],
     *     "credentials": ["At least one credential document is required."]
     *   }
     * }
     * 
     * @response 403 {
     *   "success": false,
     *   "message": "You already have a pending application."
     * }
     */
    public function store(StorePractitionerApplicationRequest $request): JsonResponse
    {
        try {
            $application = $this->applicationService->submitApplication(
                $request->user(),
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully. We will review within 3-5 business days.',
                'data' => new PractitionerApplicationResource($application->load([
                    'primaryCategory',
                    'services',
                    'documents'
                ])),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get My Application
     * 
     * Retrieve the current authenticated user's latest practitioner application.
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "user_id": 123,
     *     "status": "pending",
     *     "professional_title": "Licensed Massage Therapist",
     *     "years_experience": "5-10",
     *     "primary_category": {
     *       "id": 1,
     *       "name": "Body-Based Services"
     *     },
     *     "services": [
     *       {"id": 1, "name": "Massage Therapy"}
     *     ],
     *     "documents": [
     *       {
     *         "id": 1,
     *         "file_name": "license.pdf",
     *         "document_type": "license",
     *         "file_size_mb": 1.2
     *       }
     *     ],
     *     "rejection_reason": null,
     *     "reviewed_at": null,
     *     "submitted_at": "2024-02-08T14:30:00Z"
     *   }
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "No application found."
     * }
     */
    public function myApplication(Request $request): JsonResponse
    {
        $application = $request->user()->practitionerApplications()
            ->with(['primaryCategory', 'services', 'documents', 'reviewer'])
            ->latest('submitted_at')
            ->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'No application found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PractitionerApplicationResource($application),
        ]);
    }

    /**
     * Check Pending Application Status
     * 
     * Check if the current user has a pending practitioner application.
     * Useful for determining whether to show the application form.
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "success": true,
     *   "has_pending_application": true
     * }
     * 
     * @response 200 {
     *   "success": true,
     *   "has_pending_application": false
     * }
     */
    public function checkPendingStatus(Request $request): JsonResponse
    {
        $hasPending = $this->applicationService->userHasPendingApplication($request->user());

        return response()->json([
            'success' => true,
            'has_pending_application' => $hasPending,
        ]);
    }

    /**
     * Get Pending Applications (Admin)
     * 
     * Retrieve all pending practitioner applications for admin review.
     * Admin access required.
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "user": {
     *         "id": 123,
     *         "name": "Jane Smith",
     *         "email": "jane@example.com"
     *       },
     *       "professional_title": "Licensed Massage Therapist",
     *       "years_experience": "5-10",
     *       "primary_category": {
     *         "id": 1,
     *         "name": "Body-Based Services"
     *       },
     *       "submitted_at": "2024-02-08T14:30:00Z"
     *     }
     *   ],
     *   "count": 5
     * }
     * 
     * @response 403 {
     *   "success": false,
     *   "message": "Unauthorized. Admin access required."
     * }
     */
    public function pendingApplications(Request $request): JsonResponse
    {
        // Check if user is admin
        if (!$request->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Admin access required.',
            ], 403);
        }

        $applications = $this->applicationService->getPendingApplications();

        return response()->json([
            'success' => true,
            'data' => PractitionerApplicationResource::collection($applications),
            'count' => $applications->count(),
        ]);
    }

    /**
     * Get Application Details
     * 
     * Retrieve details of a specific practitioner application.
     * Users can only view their own applications. Admins can view any application.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The application ID. Example: 1
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "user_id": 123,
     *     "status": "pending",
     *     "professional_title": "Licensed Massage Therapist",
     *     "bio": "Experienced therapist...",
     *     "documents": [],
     *     "submitted_at": "2024-02-08T14:30:00Z"
     *   }
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Application not found."
     * }
     * 
     * @response 403 {
     *   "success": false,
     *   "message": "Unauthorized."
     * }
     */
    public function show(Request $request, int $id): JsonResponse
    {
        // Check if user is admin or owns the application
        $application = $this->applicationService->getApplicationById($id);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.',
            ], 404);
        }

        // Authorization check
        if (!$request->user()->is_admin && $application->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => new PractitionerApplicationResource($application),
        ]);
    }

    /**
     * Review Application (Admin)
     * 
     * Approve or reject a practitioner application. Admin access required.
     * When approved, a practitioner profile is automatically created.
     * Email notifications are sent to the applicant.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The application ID. Example: 1
     * 
     * @bodyParam action string required Action to take: "approve" or "reject". Example: approve
     * @bodyParam rejection_reason string optional Reason for rejection (required if action is "reject"). Example: Insufficient credentials provided.
     * @bodyParam admin_notes string optional Internal notes not shown to applicant. Example: Follow up in 6 months.
     * 
     * @response 200 {
     *   "success": true,
     *   "message": "Application approved successfully.",
     *   "data": {
     *     "application": {
     *       "id": 1,
     *       "status": "approved",
     *       "reviewed_by": 1,
     *       "reviewed_at": "2024-02-08T15:00:00Z"
     *     },
     *     "profile_id": 1
     *   }
     * }
     * 
     * @response 200 {
     *   "success": true,
     *   "message": "Application rejected.",
     *   "data": {
     *     "id": 1,
     *     "status": "rejected",
     *     "rejection_reason": "Insufficient credentials...",
     *     "reviewed_at": "2024-02-08T15:00:00Z"
     *   }
     * }
     * 
     * @response 400 {
     *   "success": false,
     *   "message": "Application has already been reviewed."
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Application not found."
     * }
     */
    public function review(ReviewApplicationRequest $request, int $id): JsonResponse
    {
        try {
            $application = $this->applicationService->getApplicationById($id);

            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found.',
                ], 404);
            }

            if (!$application->isPending()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application has already been reviewed.',
                ], 400);
            }

            $validated = $request->validated();

            if ($validated['action'] === 'approve') {
                $profile = $this->applicationService->approveApplication(
                    $application,
                    $request->user(),
                    $validated['admin_notes'] ?? null
                );

                return response()->json([
                    'success' => true,
                    'message' => 'Application approved successfully.',
                    'data' => [
                        'application' => new PractitionerApplicationResource($application->fresh([
                            'primaryCategory',
                            'services',
                            'reviewer'
                        ])),
                        'profile_id' => $profile->id,
                    ],
                ]);
            } else {
                $application = $this->applicationService->rejectApplication(
                    $application,
                    $request->user(),
                    $validated['rejection_reason'] ?? null,
                    $validated['admin_notes'] ?? null
                );

                return response()->json([
                    'success' => true,
                    'message' => 'Application rejected.',
                    'data' => new PractitionerApplicationResource($application->fresh([
                        'primaryCategory',
                        'services',
                        'reviewer'
                    ])),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to review application.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get All Applications (Admin)
     * 
     * Retrieve all practitioner applications with filtering and sorting options.
     * Admin access required.
     * 
     * @authenticated
     * 
     * @queryParam status string Filter by status: "pending", "approved", or "rejected". Example: pending
     * @queryParam category_id integer Filter by primary category ID. Example: 1
     * @queryParam sort_by string Field to sort by. Example: submitted_at
     * @queryParam sort_order string Sort order: "asc" or "desc". Example: desc
     * @queryParam per_page integer Number of results per page. Example: 15
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "user": {
     *         "id": 123,
     *         "name": "Jane Smith",
     *         "email": "jane@example.com"
     *       },
     *       "status": "pending",
     *       "professional_title": "Licensed Massage Therapist",
     *       "submitted_at": "2024-02-08T14:30:00Z"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "last_page": 3,
     *     "per_page": 15,
     *     "total": 42
     *   }
     * }
     * 
     * @response 403 {
     *   "success": false,
     *   "message": "Unauthorized. Admin access required."
     * }
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Admin access required.',
            ], 403);
        }

        $query = \App\Models\PractitionerApplication::with([
            'user',
            'primaryCategory',
            'services',
            'reviewer'
        ]);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('primary_category_id', $request->category_id);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'submitted_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $perPage = $request->get('per_page', 15);
        $applications = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => PractitionerApplicationResource::collection($applications),
            'meta' => [
                'current_page' => $applications->currentPage(),
                'last_page' => $applications->lastPage(),
                'per_page' => $applications->perPage(),
                'total' => $applications->total(),
            ],
        ]);
    }
}
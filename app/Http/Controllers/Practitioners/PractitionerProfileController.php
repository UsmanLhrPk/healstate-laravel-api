<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Http\Resources\Practitioners\PractitionerProfileResource;
use App\Services\PractitionerProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Practitioner Profiles
 * 
 * APIs for browsing and managing practitioner profiles
 */
class PractitionerProfileController extends Controller
{
    public function __construct(
        protected PractitionerProfileService $profileService
    ) {}

    /**
     * List All Practitioners
     * 
     * Get a paginated list of all active practitioner profiles with filtering,
     * searching, and sorting capabilities. Public endpoint, no authentication required.
     * 
     * @queryParam category_id integer Filter by primary service category. Example: 1
     * @queryParam service_id integer Filter by specific service subcategory. Example: 5
     * @queryParam accepting_clients boolean Only show practitioners accepting new clients. Example: true
     * @queryParam search string Search by practitioner name or professional title. Example: massage
     * @queryParam sort_by string Sort field: "created_at", "rating", or "bookings". Example: rating
     * @queryParam sort_order string Sort order: "asc" or "desc". Example: desc
     * @queryParam per_page integer Results per page (1-100). Example: 20
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "user_id": 123,
     *       "user": {
     *         "id": 123,
     *         "name": "Jane Smith"
     *       },
     *       "phone_number": "+1234567890",
     *       "professional_title": "Licensed Massage Therapist",
     *       "years_experience": "5-10",
     *       "bio": "Experienced therapist...",
     *       "primary_category": {
     *         "id": 1,
     *         "name": "Body-Based Services"
     *       },
     *       "services": [
     *         {
     *           "id": 1,
     *           "name": "Massage Therapy"
     *         }
     *       ],
     *       "is_accepting_clients": true,
     *       "statistics": {
     *         "total_bookings": 45,
     *         "average_rating": 4.85,
     *         "total_reviews": 23
     *       },
     *       "approved_at": "2024-01-15T10:30:00Z"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "last_page": 5,
     *     "per_page": 20,
     *     "total": 87
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $filters = [
            'category_id' => $request->category_id,
            'service_id' => $request->service_id,
            'accepting_clients' => $request->boolean('accepting_clients', false),
            'search' => $request->search,
            'sort_by' => $request->get('sort_by', 'created_at'),
            'sort_order' => $request->get('sort_order', 'desc'),
            'per_page' => $request->get('per_page', 15),
        ];

        $profiles = $this->profileService->getAllProfiles($filters);

        return response()->json([
            'success' => true,
            'data' => PractitionerProfileResource::collection($profiles),
            'meta' => [
                'current_page' => $profiles->currentPage(),
                'last_page' => $profiles->lastPage(),
                'per_page' => $profiles->perPage(),
                'total' => $profiles->total(),
            ],
        ]);
    }

    /**
     * Get Practitioner Profile
     * 
     * Retrieve detailed information about a specific practitioner.
     * Public endpoint, no authentication required.
     * 
     * @urlParam id integer required The practitioner profile ID. Example: 1
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "user": {
     *       "id": 123,
     *       "name": "Jane Smith"
     *     },
     *     "professional_title": "Licensed Massage Therapist",
     *     "years_experience": "5-10",
     *     "bio": "I am an experienced massage therapist...",
     *     "license_number": "LMT123456",
     *     "issuing_organization": "State Board of Massage",
     *     "primary_category": {
     *       "id": 1,
     *       "name": "Body-Based Services"
     *     },
     *     "services": [
     *       {"id": 1, "name": "Massage Therapy"},
     *       {"id": 2, "name": "Acupuncture"}
     *     ],
     *     "service_description": "I specialize in deep tissue massage...",
     *     "availability_schedule": {
     *       "monday": {"morning": true, "afternoon": false, "evening": true},
     *       "tuesday": {"morning": true, "afternoon": true, "evening": false}
     *     },
     *     "timezone": "America/New_York",
     *     "is_active": true,
     *     "is_accepting_clients": true,
     *     "profile_image_url": "https://example.com/image.jpg",
     *     "statistics": {
     *       "total_bookings": 45,
     *       "average_rating": 4.85,
     *       "total_reviews": 23
     *     },
     *     "approved_at": "2024-01-15T10:30:00Z",
     *     "created_at": "2024-01-15T10:30:00Z"
     *   }
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Practitioner profile not found."
     * }
     */
    public function show(int $id): JsonResponse
    {
        $profile = $this->profileService->getProfileById($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Practitioner profile not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PractitionerProfileResource($profile),
        ]);
    }

    /**
     * Get My Practitioner Profile
     * 
     * Retrieve the authenticated user's practitioner profile.
     * User must be an approved practitioner.
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "professional_title": "Licensed Massage Therapist",
     *     "is_active": true,
     *     "is_accepting_clients": true,
     *     "statistics": {
     *       "total_bookings": 45,
     *       "average_rating": 4.85,
     *       "total_reviews": 23
     *     }
     *   }
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "You do not have a practitioner profile."
     * }
     */
    public function myProfile(Request $request): JsonResponse
    {
        $profile = $this->profileService->getProfileByUserId($request->user()->id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have a practitioner profile.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PractitionerProfileResource($profile),
        ]);
    }

    /**
     * Update Practitioner Profile
     * 
     * Update the practitioner profile information.
     * Users can only update their own profile. Admins can update any profile.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The profile ID. Example: 1
     * 
     * @bodyParam phone_number string optional Phone number. Example: +1234567890
     * @bodyParam professional_title string optional Professional title. Example: Licensed Massage Therapist
     * @bodyParam bio string optional Bio (max 500 characters). Example: Updated bio text...
     * @bodyParam service_description string optional Service description (max 1000 characters). Example: I specialize in...
     * @bodyParam availability_schedule object optional Weekly availability. Example: {"monday": {"morning": true}}
     * @bodyParam timezone string optional Timezone. Example: America/Los_Angeles
     * @bodyParam is_accepting_clients boolean optional Whether accepting new clients. Example: true
     * @bodyParam service_subcategories array optional Array of service subcategory IDs. Example: [1, 2, 3]
     * 
     * @response 200 {
     *   "success": true,
     *   "message": "Profile updated successfully.",
     *   "data": {
     *     "id": 1,
     *     "professional_title": "Licensed Massage Therapist",
     *     "bio": "Updated bio..."
     *   }
     * }
     * 
     * @response 403 {
     *   "success": false,
     *   "message": "Unauthorized."
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Profile not found."
     * }
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $profile = $this->profileService->getProfileById($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found.',
            ], 404);
        }

        // Authorization: user must own the profile or be admin
        if ($profile->user_id !== $request->user()->id && !$request->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $validated = $request->validate([
            'phone_number' => ['sometimes', 'string', 'max:20'],
            'professional_title' => ['sometimes', 'string', 'max:255'],
            'bio' => ['sometimes', 'string', 'max:500'],
            'service_description' => ['sometimes', 'string', 'max:1000'],
            'availability_schedule' => ['sometimes', 'array'],
            'timezone' => ['sometimes', 'string', 'timezone'],
            'is_accepting_clients' => ['sometimes', 'boolean'],
            'service_subcategories' => ['sometimes', 'array'],
            'service_subcategories.*' => ['integer', 'exists:service_subcategories,id'],
        ]);

        try {
            $profile = $this->profileService->updateProfile($profile, $validated);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'data' => new PractitionerProfileResource($profile),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle Profile Active Status
     * 
     * Activate or deactivate a practitioner profile.
     * Users can toggle their own profile. Admins can toggle any profile.
     * Inactive profiles are hidden from public listings.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The profile ID. Example: 1
     * 
     * @response 200 {
     *   "success": true,
     *   "message": "Profile status updated.",
     *   "data": {
     *     "id": 1,
     *     "is_active": false
     *   }
     * }
     * 
     * @response 403 {
     *   "success": false,
     *   "message": "Unauthorized."
     * }
     * 
     * @response 404 {
     *   "success": false,
     *   "message": "Profile not found."
     * }
     */
    public function toggleActive(Request $request, int $id): JsonResponse
    {
        $profile = $this->profileService->getProfileById($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found.',
            ], 404);
        }

        // Authorization
        if ($profile->user_id !== $request->user()->id && !$request->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        try {
            $profile = $this->profileService->toggleActiveStatus($profile);

            return response()->json([
                'success' => true,
                'message' => 'Profile status updated.',
                'data' => new PractitionerProfileResource($profile),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get Top Rated Practitioners
     * 
     * Retrieve a list of the highest-rated practitioners.
     * Only includes active practitioners accepting clients.
     * Public endpoint, no authentication required.
     * 
     * @queryParam limit integer Number of practitioners to return (1-50). Example: 10
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "user": {
     *         "id": 123,
     *         "name": "Jane Smith"
     *       },
     *       "professional_title": "Licensed Massage Therapist",
     *       "statistics": {
     *         "average_rating": 4.95,
     *         "total_reviews": 120,
     *         "total_bookings": 250
     *       }
     *     }
     *   ]
     * }
     */
    public function topRated(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 10);
        $practitioners = $this->profileService->getTopRatedPractitioners($limit);

        return response()->json([
            'success' => true,
            'data' => PractitionerProfileResource::collection($practitioners),
        ]);
    }

    /**
     * Get Practitioners by Category
     * 
     * Retrieve practitioners in a specific service category.
     * Only includes active practitioners accepting clients, sorted by rating.
     * Public endpoint, no authentication required.
     * 
     * @urlParam categoryId integer required The service category ID. Example: 1
     * 
     * @queryParam limit integer Number of practitioners to return (1-50). Example: 10
     * 
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "professional_title": "Licensed Massage Therapist",
     *       "primary_category": {
     *         "id": 1,
     *         "name": "Body-Based Services"
     *       },
     *       "statistics": {
     *         "average_rating": 4.85,
     *         "total_reviews": 23
     *       }
     *     }
     *   ]
     * }
     */
    public function byCategory(Request $request, int $categoryId): JsonResponse
    {
        $limit = $request->get('limit', 10);
        $practitioners = $this->profileService->getPractitionersByCategory($categoryId, $limit);

        return response()->json([
            'success' => true,
            'data' => PractitionerProfileResource::collection($practitioners),
        ]);
    }
}
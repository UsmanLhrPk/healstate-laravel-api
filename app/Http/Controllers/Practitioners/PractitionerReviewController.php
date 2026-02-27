<?php

namespace App\Http\Controllers\Practitioners;

use App\Http\Controllers\Controller;
use App\Models\PractitionerProfile;
use App\Models\PractitionerReview;
use App\Models\PractitionerOfferingBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PractitionerReviewController extends Controller
{
    /**
     * List reviews for a practitioner profile.
     * Public endpoint.
     */
    public function index(Request $request, int $profileId): JsonResponse
    {
        $profile = PractitionerProfile::findOrFail($profileId);

        $perPage = min($request->input('per_page', 15), 100);

        $reviews = PractitionerReview::where('practitioner_profile_id', $profile->id)
            ->with('user:id,name')
            ->latest()
            ->paginate($perPage);

        return response()->json($reviews);
    }

    /**
     * Submit a review for a practitioner.
     * Requires auth + a completed booking with this practitioner.
     */
    public function store(Request $request, int $profileId): JsonResponse
    {
        $validated = $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $profile = PractitionerProfile::findOrFail($profileId);
        $userId  = auth()->id();

        // Check user has a completed booking with this practitioner
        $hasCompletedBooking = PractitionerOfferingBooking::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereHas('offering', fn ($q) =>
                $q->where('practitioner_profile_id', $profile->id)
            )
            ->exists();

        if (! $hasCompletedBooking) {
            return response()->json([
                'success' => false,
                'message' => 'You can only review practitioners after completing a booking with them.',
            ], 403);
        }

        // Check for duplicate review
        $alreadyReviewed = PractitionerReview::where('practitioner_profile_id', $profile->id)
            ->where('user_id', $userId)
            ->exists();

        if ($alreadyReviewed) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this practitioner.',
            ], 409);
        }

        $review = PractitionerReview::create([
            'practitioner_profile_id' => $profile->id,
            'user_id'                 => $userId,
            'rating'                  => $validated['rating'],
            'comment'                 => $validated['comment'] ?? null,
        ]);

        // Update statistics on the profile
        $this->updateProfileStatistics($profile);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully.',
            'data'    => $review->load('user:id,name'),
        ], 201);
    }

    /**
     * Check if the current user can review this practitioner.
     * Returns eligibility + whether they already reviewed.
     */
    public function checkEligibility(int $profileId): JsonResponse
    {
        $userId  = auth()->id();
        $profile = PractitionerProfile::findOrFail($profileId);

        $hasCompletedBooking = PractitionerOfferingBooking::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereHas('offering', fn ($q) =>
                $q->where('practitioner_profile_id', $profile->id)
            )
            ->exists();

        $alreadyReviewed = PractitionerReview::where('practitioner_profile_id', $profile->id)
            ->where('user_id', $userId)
            ->exists();

        return response()->json([
            'can_review'       => $hasCompletedBooking && ! $alreadyReviewed,
            'has_booking'      => $hasCompletedBooking,
            'already_reviewed' => $alreadyReviewed,
        ]);
    }

    private function updateProfileStatistics(PractitionerProfile $profile): void
    {
        $stats = PractitionerReview::where('practitioner_profile_id', $profile->id)
            ->selectRaw('COUNT(*) as total, AVG(rating) as avg_rating')
            ->first();

        $profile->update([
            'total_reviews'  => $stats->total ?? 0,
            'average_rating' => $stats->avg_rating ?? null,
        ]);
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();
        
        // Merge guest cart with user cart
        $sessionId = $request->header('X-Cart-Session-ID') 
                     ?? $request->cookie('cart_session_id');
        
        if ($sessionId) {
            $this->cartService->mergeGuestCart($user->id, $sessionId);
        }
        
        // Load vendor and practitioner relationships
        $user->load(['vendor', 'practitionerProfile']);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $this->formatUser($user),
        ]);
    }

    /**
     * Get the authenticated user's data.
     */
    public function user(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // Load vendor and practitioner relationships
        $user->load(['vendor', 'practitionerProfile']);
        
        return response()->json([
            'user' => $this->formatUser($user),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }

    /**
     * Format user data for API responses.
     */
    private function formatUser($user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'vendor_id' => $user->vendor?->id,
            'is_vendor' => $user->vendor?->isApproved() ?? false,
            'has_pending_vendor_application' => $user->vendor?->isPending() ?? false,
            'is_practitioner' => $user->is_practitioner ?? false,
            'practitioner_profile_id' => $user->practitioner_profile_id,
            'has_pending_practitioner_application' => $user->hasPendingPractitionerApplication(),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
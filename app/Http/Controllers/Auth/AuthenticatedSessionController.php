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
        
        // Load vendor relationship
        $user->load('vendor');

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'vendor_id' => $user->vendor?->id,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
        ]);
    }

    /**
     * Get the authenticated user's data.
     */
    public function user(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // Load vendor relationship
        $user->load('vendor');
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'vendor_id' => $user->vendor?->id,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
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
}
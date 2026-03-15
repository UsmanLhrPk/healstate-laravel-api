<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Admin Authentication
 * 
 * APIs for admin authentication (separate from regular users)
 */
class AdminLoginController extends Controller
{
    /**
     * Admin Login
     * 
     * Authenticate an admin and receive a bearer token.
     * Use this token with the admin guard for admin-only endpoints.
     * 
     * @bodyParam email string required Admin email address. Example: admin@example.com
     * @bodyParam password string required Admin password. Example: password
     * 
     * @response 200 {
     *   "token": "2|xxxxxxxxxxxxxxxxxxxxxxxx",
     *   "admin": {
     *     "id": 1,
     *     "name": "Admin User",
     *     "email": "admin@example.com"
     *   }
     * }
     * 
     * @response 422 {
     *   "message": "The provided credentials are incorrect.",
     *   "errors": {
     *     "email": ["The provided credentials are incorrect."]
     *   }
     * }
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create token using admin guard
        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
        ]);
    }

    /**
     * Admin Logout
     * 
     * Logout and invalidate the current admin token.
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "message": "Logged out successfully"
     * }
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user('admin')->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get Current Admin
     * 
     * Get the currently authenticated admin user's information.
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "admin": {
     *     "id": 1,
     *     "name": "Admin User",
     *     "email": "admin@example.com",
     *     "email_verified_at": "2024-02-08T10:00:00Z",
     *     "created_at": "2024-02-08T10:00:00Z"
     *   }
     * }
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'admin' => $request->user('admin'),
        ]);
    }
}
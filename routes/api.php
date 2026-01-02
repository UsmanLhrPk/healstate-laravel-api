<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Forums\CommentController;
use App\Http\Controllers\Forums\FlagController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\Forums\LikeController;
use App\Http\Controllers\Vendors\BookingController;
use App\Http\Controllers\Vendors\ProductController;
use App\Http\Controllers\Vendors\SlotController;
use App\Http\Controllers\Vendors\VariantController;
use App\Http\Controllers\Vendors\ReviewController;
use App\Http\Controllers\Vendors\VendorController;
use App\Http\Controllers\Vendors\AvailabilityController;
use Illuminate\Support\Facades\Route;

// Public routes (no auth required)
Route::get('/forums', [ForumController::class, 'index']);
Route::get('/forums/{id}', [ForumController::class, 'show']);
Route::get('/comments', [CommentController::class, 'index']);

Route::get('/vendors/{vendor}', [VendorController::class, 'show']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/vendors/{vendor}/reviews', [ReviewController::class, 'index']);
Route::get('/slots/{slot}/availability', [BookingController::class,  'availability']);

// Protected routes (auth required)
Route::middleware('auth:sanctum')->group(function () {
    // Forums
    Route::post('/forums', [ForumController::class, 'store']);
    Route::delete('/forums/{id}', [ForumController::class, 'destroy']);
    Route::post('/forums/{id}/view', [ForumController::class, 'recordView']);

    // Comments
    Route::post('/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // Likes
    Route::post('/likes', [LikeController::class, 'store']);

    // Flags
    Route::post('/flags', [FlagController::class, 'store']);
    // Add this to your routes/api.php

    Route::post('/vendors', [VendorController::class, 'store']);
    Route::put('/vendors/{vendor}', [VendorController::class, 'update']);
    Route::patch('/vendors/{vendor}/verify', [VendorController::class, 'verify']);
    
    // Product routes
    Route::post('/vendors/{vendor}/products', [ProductController::class, 'store']);
    Route::get('/vendors/{vendor}/products', [ProductController::class, 'index']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    
    // Variant routes
    Route::post('/products/{product}/variants', [VariantController::class, 'store']);
    Route::post('/variants/{variant}', [VariantController::class, 'update']);
    Route::delete('/variants/{variant}', [VariantController::class, 'destroy']);
    
    // Service slot routes
    Route::post('/products/{product}/slots', [SlotController::class, 'store']);
    Route::put('/slots/{slot}', [SlotController::class, 'update']);
    Route::delete('/slots/{slot}', [SlotController::class, 'destroy']);
    
    // Booking routes
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);
    
    // Review routes
    Route::post('/vendors/{vendor}/reviews', [ReviewController::class, 'store']);

    // Availability routes
    Route::post('/slots/{slot}/schedule', [AvailabilityController::class, 'store']);
    Route::get('/slots/{slot}/schedule', [AvailabilityController::class, 'show']);
    Route::delete('/slots/{slot}/schedule', [AvailabilityController::class, 'destroy']);
});

Route::get('/user', [AuthenticatedSessionController::class, 'user'])
    ->middleware('auth:sanctum')
    ->name('user.info');

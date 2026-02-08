<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Cart\AddressController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\CheckoutController;
use App\Http\Controllers\Cart\OrderController;
use App\Http\Controllers\Forums\CommentController;
use App\Http\Controllers\Forums\FlagController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\Forums\LikeController;
use App\Http\Controllers\Practitioners\PractitionerApplicationController;
use App\Http\Controllers\Practitioners\PractitionerProfileController;
use App\Http\Controllers\Practitioners\ServiceCategoryController;
use App\Http\Controllers\Vendors\AvailabilityController;
use App\Http\Controllers\Vendors\BookingController;
use App\Http\Controllers\Vendors\ProductController;
use App\Http\Controllers\Vendors\ReviewController;
use App\Http\Controllers\Vendors\SlotController;
use App\Http\Controllers\Vendors\VariantController;
use App\Http\Controllers\Vendors\VendorController;
use App\Http\Controllers\Vendors\VendorOrderController;
use App\Http\Controllers\Webhooks\StripeWebhookController;
use Illuminate\Support\Facades\Route;

// Public routes (no auth required)
Route::get('/forums', [ForumController::class, 'index']);
Route::get('/forums/{id}', [ForumController::class, 'show']);
Route::get('/comments', [CommentController::class, 'index']);

Route::get('/vendors/{vendor}', [VendorController::class, 'show']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/vendors/{vendor}/reviews', [ReviewController::class, 'index']);
Route::get('/slots/{slot}/availability', [BookingController::class,  'availability']);
Route::get('/marketplace', [App\Http\Controllers\Vendors\MarketplaceController::class, 'index']);

// Practitioner Public Routes
Route::prefix('practitioners')->group(function () {
    // Service Categories
    Route::get('/categories', [ServiceCategoryController::class, 'index']);
    Route::get('/categories/{id}', [ServiceCategoryController::class, 'show']);
    Route::get('/categories/slug/{slug}', [ServiceCategoryController::class, 'showBySlug']);
    Route::get('/categories/{categoryId}/subcategories', [ServiceCategoryController::class, 'subcategories']);
    
    // Practitioner Profiles (Public listing)
    Route::get('/profiles', [PractitionerProfileController::class, 'index']);
    Route::get('/profiles/{id}', [PractitionerProfileController::class, 'show']);
    Route::get('/profiles/top-rated', [PractitionerProfileController::class, 'topRated']);
    Route::get('/profiles/category/{categoryId}', [PractitionerProfileController::class, 'byCategory']);
});

Route::prefix('cart')->middleware('optional-auth:sanctum')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::put('/{cart}', [CartController::class, 'update']);
    Route::delete('/{cart}', [CartController::class, 'destroy']);
    Route::delete('/', [CartController::class, 'clear']);
    Route::get('/count', [CartController::class, 'count']);
});

// Public Checkout Routes
Route::prefix('checkout')->middleware('optional-auth:sanctum')->group(function () {
    Route::post('/payment-intent', [CheckoutController::class, 'createPaymentIntent']);
    Route::post('/process', [CheckoutController::class, 'processCheckout']);
    Route::post('/verify-payment', [CheckoutController::class, 'verifyPayment']);
});

Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handleWebhook']);

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

    // Vendor Management
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

    // Address Management
    Route::prefix('addresses')->group(function () {
        Route::get('/', [AddressController::class, 'index']);
        Route::post('/', [AddressController::class, 'store']);
        Route::put('/{address}', [AddressController::class, 'update']);
        Route::delete('/{address}', [AddressController::class, 'destroy']);
        Route::patch('/{address}/default', [AddressController::class, 'setDefault']);
    });

    // Order Management (Customer Side)
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::get('/{order}/cancellation-status', [OrderController::class, 'checkCancellationStatus']);
        Route::post('/{order}/cancel', [OrderController::class, 'cancel']);
    });

    // Vendor Order Management
    Route::prefix('vendor/orders')->group(function () {
        Route::get('/', [VendorOrderController::class, 'index']);
        Route::get('/{order}', [VendorOrderController::class, 'show']);
        Route::patch('/{order}/status', [VendorOrderController::class, 'updateStatus']);
        Route::post('/{order}/cancel', [VendorOrderController::class, 'cancelOrder']);
        Route::post('/{order}/approve-cancellation', [VendorOrderController::class, 'approveCancellation']);
        Route::post('/{order}/deny-cancellation', [VendorOrderController::class, 'denyCancellation']);
    });

    // Practitioner Application Routes (Authenticated)
    Route::prefix('practitioners')->group(function () {
        Route::post('/applications', [PractitionerApplicationController::class, 'store']);
        Route::get('/applications/my-application', [PractitionerApplicationController::class, 'myApplication']);
        Route::get('/applications/check-pending', [PractitionerApplicationController::class, 'checkPendingStatus']);
        Route::get('/applications/{id}', [PractitionerApplicationController::class, 'show']);
        
        // Practitioner Profile Management
        Route::get('/my-profile', [PractitionerProfileController::class, 'myProfile']);
        Route::put('/profiles/{id}', [PractitionerProfileController::class, 'update']);
        Route::post('/profiles/{id}/toggle-active', [PractitionerProfileController::class, 'toggleActive']);
    });

    // Admin Routes - Practitioner Management
    Route::middleware('admin')->prefix('admin/practitioners')->group(function () {
        Route::get('/applications', [PractitionerApplicationController::class, 'index']);
        Route::get('/applications/pending', [PractitionerApplicationController::class, 'pendingApplications']);
        Route::post('/applications/{id}/review', [PractitionerApplicationController::class, 'review']);
    });
});

Route::get('/user', [AuthenticatedSessionController::class, 'user'])
    ->middleware('auth:sanctum')
    ->name('user.info');
<?php

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\CheckoutController;
use App\Http\Controllers\Courses\AdminCourseController;
use App\Http\Controllers\Courses\CourseController;
use App\Http\Controllers\Courses\CourseLessonController;
use App\Http\Controllers\Courses\CourseMediaController;
use App\Http\Controllers\Courses\CourseReviewController;
use App\Http\Controllers\Courses\CourseSectionController;
use App\Http\Controllers\Forums\CommentController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\Practitioners\PractitionerApplicationController;
use App\Http\Controllers\Practitioners\PractitionerAvailabilityController;
use App\Http\Controllers\Practitioners\PractitionerOfferingAvailabilityController;
use App\Http\Controllers\Practitioners\PractitionerOfferingBookingController;
use App\Http\Controllers\Practitioners\PractitionerOfferingController;
use App\Http\Controllers\Practitioners\PractitionerProfileController;
use App\Http\Controllers\Practitioners\PractitionerReviewController;
use App\Http\Controllers\Practitioners\ServiceCategoryController;
use App\Http\Controllers\Vendors\BookingController;
use App\Http\Controllers\Vendors\MarketplaceController;
use App\Http\Controllers\Vendors\ProductController;
use App\Http\Controllers\Vendors\ReviewController;
use App\Http\Controllers\Vendors\VariantController;
use App\Http\Controllers\Vendors\VendorController;
use App\Http\Controllers\Vendors\VendorOrderController;
use App\Http\Controllers\Webhooks\StripeWebhookController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────────────────────────

Route::get('/forums', [ForumController::class, 'index']);
Route::get('/forums/{id}', [ForumController::class, 'show']);
Route::get('/comments', [CommentController::class, 'index']);

Route::get('/vendors/{vendor}', [VendorController::class, 'show']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/vendors/{vendor}/reviews', [ReviewController::class, 'index']);
Route::get('/marketplace', [MarketplaceController::class, 'index']);
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}/reviews', [CourseReviewController::class, 'index']);

// Practitioner public routes
Route::prefix('practitioners')->group(function () {
    // Service Categories
    Route::get('/categories', [ServiceCategoryController::class, 'index']);
    Route::get('/categories/{id}', [ServiceCategoryController::class, 'show']);
    Route::get('/categories/slug/{slug}', [ServiceCategoryController::class, 'showBySlug']);
    Route::get('/categories/{categoryId}/subcategories', [ServiceCategoryController::class, 'subcategories']);

    // Practitioner Profiles
    Route::get('/profiles', [PractitionerProfileController::class, 'index']);
    Route::get('/profiles/{id}', [PractitionerProfileController::class, 'show']);
    Route::get('/profiles/top-rated', [PractitionerProfileController::class, 'topRated']);
    Route::get('/profiles/category/{categoryId}', [PractitionerProfileController::class, 'byCategory']);
    Route::get('/profiles/{profileId}/reviews', [PractitionerReviewController::class, 'index']);
    Route::get('/profiles/{profile}/offerings', [PractitionerOfferingController::class, 'profileOfferings']);

    // ⚠️  Literal-segment routes MUST come before the {offering} wildcard.
    // Laravel matches routes in registration order — "browse" would be treated
    // as an offering ID if {offering} is registered first.
    Route::get('/offerings/browse', [PractitionerOfferingController::class, 'browse']); // public marketplace
    Route::get('/offerings', [PractitionerOfferingController::class, 'bySubcategory']);  // ?subcategory_id=X
    Route::get('/offerings/{offering}', [PractitionerOfferingController::class, 'show']); // ← wildcard last

    // Slot availability — public so customers can browse before booking
    Route::get('/offering-slots/{slot}/availability', [PractitionerOfferingBookingController::class, 'availability']);
});

// Cart
Route::prefix('cart')->middleware('optional-auth:sanctum')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::put('/{cart}', [CartController::class, 'update']);
    Route::delete('/{cart}', [CartController::class, 'destroy']);
    Route::delete('/', [CartController::class, 'clear']);
    Route::get('/count', [CartController::class, 'count']);
});

// Checkout
Route::prefix('checkout')->middleware('optional-auth:sanctum')->group(function () {
    Route::post('/payment-intent', [CheckoutController::class, 'createPaymentIntent']);
    Route::post('/process', [CheckoutController::class, 'processCheckout']);
    Route::post('/verify-payment', [CheckoutController::class, 'verifyPayment']);
});

// Vendor slot availability (legacy)
Route::get('/slots/{slot}/availability', [BookingController::class, 'availability']);

Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handleWebhook']);

// ─────────────────────────────────────────────────────────────
// PROTECTED ROUTES
// ─────────────────────────────────────────────────────────────

Route::middleware('auth:sanctum')->group(function () {

    // Forums
    Route::post('/forums', [ForumController::class, 'store']);
    Route::delete('/forums/{id}', [ForumController::class, 'destroy']);
    Route::post('/forums/{id}/view', [ForumController::class, 'recordView']);

    // Comments
    Route::post('/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // Likes & Flags
    Route::post('/likes', [\App\Http\Controllers\Forums\LikeController::class, 'store']);
    Route::post('/flags', [\App\Http\Controllers\Forums\FlagController::class, 'store']);

    // ── Vendor Management ────────────────────────────────────
    Route::post('/vendors', [VendorController::class, 'store']);
    Route::put('/vendors/{vendor}', [VendorController::class, 'update']);
    Route::patch('/vendors/{vendor}/verify', [VendorController::class, 'verify']);

    // Vendor Products (physical only)
    Route::post('/vendors/{vendor}/products', [ProductController::class, 'store']);
    Route::get('/vendors/{vendor}/products', [ProductController::class, 'index']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // Product Variants
    Route::post('/products/{product}/variants', [VariantController::class, 'store']);
    Route::post('/variants/{variant}', [VariantController::class, 'update']);
    Route::delete('/variants/{variant}', [VariantController::class, 'destroy']);

    // Vendor Reviews
    Route::post('/vendors/{vendor}/reviews', [ReviewController::class, 'store']);

    // Courses
    Route::get('/my/courses', [CourseController::class, 'myCourses']);
    Route::get('/my/course-enrollments', [CourseController::class, 'myEnrollments']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll']);
    Route::get('/courses/{course}/my-enrollment', [CourseController::class, 'myEnrollment']);
    Route::get('/courses/{course}/lessons/{lesson}', [CourseLessonController::class, 'show']);
    Route::patch('/courses/{course}/lessons/{lesson}/progress', [CourseLessonController::class, 'updateProgress']);
    Route::post('/courses/{course}/reviews', [CourseReviewController::class, 'store']);
    Route::delete('/courses/{course}/reviews', [CourseReviewController::class, 'destroy']);
    Route::get('/courses/{course}/media', [CourseMediaController::class, 'index']);
    Route::post('/courses/{course}/media', [CourseMediaController::class, 'store']);
    Route::post('/courses/{course}/lessons/{lesson}/media', [CourseMediaController::class, 'storeForLesson']);
    Route::delete('/courses/media/{media}', [CourseMediaController::class, 'destroy']);
    Route::get('/course-categories', [CourseController::class, 'categories']);
    Route::get('/instructor/courses', [CourseController::class, 'instructorCourses']);
    Route::get('/instructor/courses/{courseId}', [CourseController::class, 'instructorCourse']);
    Route::put('/instructor/courses/{course:slug}', [CourseController::class, 'instructorUpdate']);
    Route::delete('/instructor/courses/{courseId}', [CourseController::class, 'instructorDestroy']);
    Route::post('/instructor/courses/{courseId}/submit', [CourseController::class, 'instructorSubmit']);
    Route::post('/instructor/courses/{courseId}/archive', [CourseController::class, 'instructorArchive']);
    Route::post('/courses/{course}/submit', [CourseController::class, 'submit']);

    // Course builder — sections
    Route::post('/courses/{course}/sections', [CourseSectionController::class, 'store']);
    Route::put('/courses/{course}/sections/{section}', [CourseSectionController::class, 'update']);
    Route::delete('/courses/{course}/sections/{section}', [CourseSectionController::class, 'destroy']);

    // Course builder — lessons
    Route::post('/courses/{course}/sections/{section}/lessons', [CourseLessonController::class, 'store']);
    Route::put('/courses/{course}/lessons/{lesson}', [CourseLessonController::class, 'update']);
    Route::delete('/courses/{course}/lessons/{lesson}', [CourseLessonController::class, 'destroy']);

    // Addresses
    Route::prefix('addresses')->group(function () {
        Route::get('/', [\App\Http\Controllers\Cart\AddressController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Cart\AddressController::class, 'store']);
        Route::put('/{address}', [\App\Http\Controllers\Cart\AddressController::class, 'update']);
        Route::delete('/{address}', [\App\Http\Controllers\Cart\AddressController::class, 'destroy']);
        Route::patch('/{address}/default', [\App\Http\Controllers\Cart\AddressController::class, 'setDefault']);
    });

    // Customer Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [\App\Http\Controllers\Cart\OrderController::class, 'index']);
        Route::get('/{order}', [\App\Http\Controllers\Cart\OrderController::class, 'show']);
        Route::get('/{order}/cancellation-status', [\App\Http\Controllers\Cart\OrderController::class, 'checkCancellationStatus']);
        Route::post('/{order}/cancel', [\App\Http\Controllers\Cart\OrderController::class, 'cancel']);
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

    // ── Practitioner Routes ──────────────────────────────────
    Route::prefix('practitioners')->group(function () {

        // Applications
        Route::post('/applications', [PractitionerApplicationController::class, 'store']);
        Route::get('/applications/my-application', [PractitionerApplicationController::class, 'myApplication']);
        Route::get('/applications/check-pending', [PractitionerApplicationController::class, 'checkPendingStatus']);
        Route::get('/applications/{id}', [PractitionerApplicationController::class, 'show']);

        // Profile Management
        Route::get('/my-profile', [PractitionerProfileController::class, 'myProfile']);
        Route::put('/profiles/{id}', [PractitionerProfileController::class, 'update']);
        Route::post('/profiles/{id}/toggle-active', [PractitionerProfileController::class, 'toggleActive']);
        Route::post('/profiles/{profileId}/reviews', [PractitionerReviewController::class, 'store']);
        Route::get('/profiles/{profileId}/reviews/eligibility', [PractitionerReviewController::class, 'checkEligibility']);

        // ⚠️  /offerings/all MUST be registered before PUT/DELETE /offerings/{offering}
        // so Laravel doesn't try to resolve "all" as a model ID when a GET comes in.
        Route::get('/offerings/all', [PractitionerOfferingController::class, 'index']); // dashboard, auth-scoped

        // Offering CRUD — wildcard routes after the literal /all
        Route::post('/profiles/{profile}/offerings', [PractitionerOfferingController::class, 'store']);
        Route::put('/offerings/{offering}', [PractitionerOfferingController::class, 'update']);
        Route::delete('/offerings/{offering}', [PractitionerOfferingController::class, 'destroy']);

        // Offering Slot Availability Schedule
        Route::post('/offering-slots/{slot}/schedule', [PractitionerOfferingAvailabilityController::class, 'store']);
        Route::get('/offering-slots/{slot}/schedule', [PractitionerOfferingAvailabilityController::class, 'show']);
        Route::delete('/offering-slots/{slot}/schedule', [PractitionerOfferingAvailabilityController::class, 'destroy']);

        // Bookings — customer side
        Route::post('/bookings', [PractitionerOfferingBookingController::class, 'store']);
        Route::get('/bookings', [PractitionerOfferingBookingController::class, 'index']);
        Route::patch('/bookings/{booking}/cancel', [PractitionerOfferingBookingController::class, 'cancel']);
        Route::post('/bookings/{booking}/request-cancellation', [PractitionerOfferingBookingController::class, 'requestCancellation']);

        // Bookings — practitioner's incoming
        Route::get('/my-bookings', [PractitionerOfferingBookingController::class, 'practitionerIndex']);
        Route::post('/my-bookings/{booking}/approve-cancellation', [PractitionerOfferingBookingController::class, 'approveCancellation']);
        Route::post('/my-bookings/{booking}/deny-cancellation', [PractitionerOfferingBookingController::class, 'denyCancellation']);

        Route::prefix('availability')->group(function () {
            Route::get('/', [PractitionerAvailabilityController::class, 'index']);
            Route::post('/repeat', [PractitionerAvailabilityController::class, 'repeat']);
            Route::get('/check-skip', [PractitionerAvailabilityController::class, 'checkSkip']); // NEW
            Route::post('/skip', [PractitionerAvailabilityController::class, 'skip']);
            Route::delete('/skip', [PractitionerAvailabilityController::class, 'unskip']);
            Route::put('/pattern', [PractitionerAvailabilityController::class, 'updatePattern']); // NEW
        });
    });
});

Route::get('/user', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'user'])
    ->middleware('auth:sanctum')
    ->name('user.info');

// ─────────────────────────────────────────────────────────────
// ADMIN ROUTES
// ─────────────────────────────────────────────────────────────

Route::prefix('admin')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Auth\AdminLoginController::class, 'logout']);
        Route::get('/user', [\App\Http\Controllers\Auth\AdminLoginController::class, 'user']);

        Route::prefix('practitioners')->group(function () {
            Route::get('/applications', [PractitionerApplicationController::class, 'index']);
            Route::get('/applications/{id}', [PractitionerApplicationController::class, 'show']);
            Route::get('/applications/pending', [PractitionerApplicationController::class, 'pendingApplications']);
            Route::post('/applications/{id}/review', [PractitionerApplicationController::class, 'review']);
            Route::get('/documents/{document}/download', [PractitionerApplicationController::class, 'downloadDocument']);
        });

        Route::prefix('vendors')->group(function () {
            Route::get('/', [VendorController::class, 'index']);
            Route::get('/{id}', [VendorController::class, 'adminShow']);
            Route::post('/{id}/review', [VendorController::class, 'review']);
        });

        Route::prefix('courses')->group(function () {
            Route::get('/', [AdminCourseController::class, 'index']);
            Route::get('/pending', [AdminCourseController::class, 'pending']);

            Route::get('/{course:id}', [AdminCourseController::class, 'show']);
            Route::post('/{course:id}/approve', [AdminCourseController::class, 'approve']);
            Route::post('/{course:id}/reject', [AdminCourseController::class, 'reject']);
            Route::patch('/{course:id}/feature', [AdminCourseController::class, 'toggleFeatured']);
            Route::patch('/{course:id}/deactivate', [AdminCourseController::class, 'deactivate']);
            Route::delete('/{course:id}', [AdminCourseController::class, 'destroy']);

            Route::delete('/reviews/{review}', [CourseReviewController::class, 'adminDestroy']);
        });

    });
});

Route::middleware('optional-auth:sanctum')->group(function () {
    Route::get('/courses/{course}', [CourseController::class, 'show']);
});
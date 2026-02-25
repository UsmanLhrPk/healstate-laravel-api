<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'api'])
                ->group(base_path('routes/auth.php'));

            Route::middleware(['web', 'api'])
                ->get('/sanctum/csrf-cookie', \Laravel\Sanctum\Http\Controllers\CsrfCookieController::class.'@show')
                ->name('sanctum.csrf-cookie');
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            '*',
        ]);

        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'optional-auth' => \App\Http\Middleware\OptionalAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->renderable(function (ValidationException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'error' => 'You must be authenticated to access this resource',
                ], 401);
            }
        });

        $exceptions->renderable(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Forbidden',
                    'error' => 'You do not have permission to access this resource',
                ], 403);
            }
        });

        $exceptions->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Method not allowed',
                    'error' => 'The HTTP method used is not supported for this endpoint',
                ], 405);
            }
        });

        $exceptions->renderable(function (ModelNotFoundException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                $model = class_basename($e->getModel());
                $ids = implode(', ', $e->getIds());

                $friendlyNames = [
                    'Vendor' => 'vendor',
                    'Product' => 'product',
                    'ProductVariant' => 'product variant',
                    'ServiceSlot' => 'service slot',
                    'ServiceBooking' => 'booking',
                    'VendorReview' => 'review',
                    'User' => 'user',
                ];

                $modelName = $friendlyNames[$model] ?? strtolower($model);

                return response()->json([
                    'message' => 'Resource not found',
                    'error' => "The {$modelName} with ID {$ids} was not found",
                ], 404);
            }
        });

        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                $previous = $e->getPrevious();
                if ($previous instanceof ModelNotFoundException) {
                    $model = class_basename($previous->getModel());
                    $ids = implode(', ', $previous->getIds());

                    $friendlyNames = [
                        'Vendor' => 'vendor',
                        'Product' => 'product',
                        'ProductVariant' => 'product variant',
                        'ServiceSlot' => 'service slot',
                        'ServiceBooking' => 'booking',
                        'VendorReview' => 'review',
                        'User' => 'user',
                    ];

                    $modelName = $friendlyNames[$model] ?? strtolower($model);

                    return response()->json([
                        'message' => 'Resource not found',
                        'error' => "The {$modelName} with ID {$ids} was not found",
                    ], 404);
                }

                return response()->json([
                    'message' => 'Endpoint not found',
                    'error' => 'The requested URL was not found on this server',
                ], 404);
            }
        });

        $exceptions->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

                if (config('app.debug')) {
                    return response()->json([
                        'message' => 'Server error',
                        'error' => $e->getMessage(),
                        'exception' => get_class($e),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                    ], $statusCode);
                }

                return response()->json([
                    'message' => 'Server error',
                    'error' => 'An unexpected error occurred. Please try again later.',
                ], $statusCode);
            }
        });

    })->create();

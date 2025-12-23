<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Forums\CommentController;
use App\Http\Controllers\Forums\FlagController;
use App\Http\Controllers\Forums\ForumController;
use App\Http\Controllers\Forums\LikeController;
use Illuminate\Support\Facades\Route;

// Public routes (no auth required)
Route::get('/forums', [ForumController::class, 'index']);
Route::get('/forums/{id}', [ForumController::class, 'show']);
Route::get('/comments', [CommentController::class, 'index']);

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
});

Route::get('/user', [AuthenticatedSessionController::class, 'user'])
    ->middleware('auth:sanctum')
    ->name('user.info');

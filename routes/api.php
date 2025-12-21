<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FlagController;

// Public routes (no auth required)
Route::get('/forums', [ForumController::class, 'index']);
Route::get('/forums/{id}', [ForumController::class, 'show']);
Route::get('/comments', [CommentController::class, 'index']);

// Protected routes (auth required)
Route::middleware('auth:sanctum')->group(function () {
    // Forums
    Route::post('/forums', [ForumController::class, 'store']);
    Route::delete('/forums/{id}', [ForumController::class, 'destroy']);

    // Comments
    Route::post('/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // Likes
    Route::post('/likes', [LikeController::class, 'toggle']);

    // Flags
    Route::post('/flags', [FlagController::class, 'store']);
});
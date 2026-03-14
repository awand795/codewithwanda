<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdminCategoryController;
use App\Http\Controllers\Api\AdminCourseController;
use App\Http\Controllers\Api\AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Admin routes - All admin routes are API only with Sanctum tokens
Route::prefix('admin')->group(function () {
    // Public admin login (no CSRF required for token-based auth)
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Protected admin routes
    Route::middleware('auth:sanctum', 'admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'stats']);

        // Admin auth
        Route::get('/user', [AdminAuthController::class, 'user']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/admins', [AdminAuthController::class, 'admins']);
        Route::post('/admins', [AdminAuthController::class, 'store']);
        Route::put('/admins/{admin}', [AdminAuthController::class, 'update']);
        Route::delete('/admins/{admin}', [AdminAuthController::class, 'destroy']);

        // Courses management
        Route::get('/courses', [AdminCourseController::class, 'index']);
        Route::get('/courses/{course}', [AdminCourseController::class, 'show']);
        Route::post('/courses', [AdminCourseController::class, 'store']);
        Route::put('/courses/{course}', [AdminCourseController::class, 'update']);
        Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy']);
        Route::post('/courses/bulk-publish', [AdminCourseController::class, 'bulkPublish']);
        Route::post('/courses/bulk-unpublish', [AdminCourseController::class, 'bulkUnpublish']);

        // Categories management
        Route::get('/categories', [AdminCategoryController::class, 'index']);
        Route::get('/categories/{category}', [AdminCategoryController::class, 'show']);
        Route::post('/categories', [AdminCategoryController::class, 'store']);
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update']);
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy']);
    });
});

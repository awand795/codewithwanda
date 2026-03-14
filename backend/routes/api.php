<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdminCategoryController;
use App\Http\Controllers\Api\AdminCourseController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CompilerController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LandingController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProgressController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/landing', [LandingController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{slug}', [CourseController::class, 'show']);

// Midtrans webhook (no auth)
Route::post('/payments/webhook', [PaymentController::class, 'webhook']);

// Compiler API (public for code execution)
Route::get('/compiler/languages', [CompilerController::class, 'languages']);
Route::post('/compiler/execute', [CompilerController::class, 'execute']);
Route::post('/compiler/test', [CompilerController::class, 'test']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/lessons/{slug}', [LessonController::class, 'show']);

    Route::post('/progress/{lesson}', [ProgressController::class, 'store']);
    Route::get('/progress/course/{course}', [ProgressController::class, 'index']);
    Route::get('/progress/course/{course}/summary', [ProgressController::class, 'summary']);

    Route::post('/payments/create', [PaymentController::class, 'create']);
    Route::get('/payments/status/{orderId}', [PaymentController::class, 'status']);
    Route::get('/payments/history', [PaymentController::class, 'history']);
});

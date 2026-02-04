<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\ImpactController;
use App\Http\Controllers\Api\VolunteerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API Routes
Route::prefix('v1')->group(function () {
    // Impact metrics for public display
    Route::get('/impact-metrics', [ImpactController::class, 'index']);
    Route::get('/impact-metrics/featured', [ImpactController::class, 'featured']);
    
    // Donation statistics (public)
    Route::get('/donations/stats', [DonationController::class, 'publicStats']);
    
    // Volunteer count (public)
    Route::get('/volunteers/count', [VolunteerController::class, 'publicCount']);
});

// Protected API Routes
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('donations', DonationController::class)->only(['index', 'show']);
        Route::apiResource('volunteers', VolunteerController::class)->only(['index', 'show', 'update']);
        Route::apiResource('impact-metrics', ImpactController::class);
    });
});
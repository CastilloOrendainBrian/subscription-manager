<?php

use App\Http\Controllers\API\SubscriptionPlatformController;
use Illuminate\Support\Facades\Route;

// Public routes

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('subscription-platform')->group(function () {
        Route::post('/', [SubscriptionPlatformController::class, 'store']);
        Route::get('/', [SubscriptionPlatformController::class, 'index']);
        Route::get('{subscription_platform}', [SubscriptionPlatformController::class, 'show']);
        Route::put('{subscription_platform}', [SubscriptionPlatformController::class, 'update']);
        Route::delete('{subscription_platform}', [SubscriptionPlatformController::class, 'destroy']);
    });
});
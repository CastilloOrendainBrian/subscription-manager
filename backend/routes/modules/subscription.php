<?php

use App\Http\Controllers\API\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Public routes

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('subscription')->group(function () {
        Route::post('/', [SubscriptionController::class, 'store']);
        Route::get('/', [SubscriptionController::class, 'index']);
        Route::get('{subscription}', [SubscriptionController::class, 'show']);
        Route::put('{subscription}', [SubscriptionController::class, 'update']);
        Route::delete('{subscription}', [SubscriptionController::class, 'destroy']);
    });
});
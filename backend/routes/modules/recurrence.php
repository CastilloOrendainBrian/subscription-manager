<?php

use App\Http\Controllers\API\RecurrenceController;
use Illuminate\Support\Facades\Route;

// Public routes

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('recurrence')->group(function () {
        Route::post('/', [RecurrenceController::class, 'store']);
        Route::get('/', [RecurrenceController::class, 'index']);
        Route::get('{recurrence}', [RecurrenceController::class, 'show']);
        Route::put('{recurrence}', [RecurrenceController::class, 'update']);
        Route::delete('{recurrence}', [RecurrenceController::class, 'destroy']);
    });
});
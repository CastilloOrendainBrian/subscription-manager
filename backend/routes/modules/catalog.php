<?php

use App\Http\Controllers\API\Catalog\CatCurrencyController;
use App\Http\Controllers\API\Catalog\CatDayController;
use App\Http\Controllers\API\Catalog\CatMonthController;
use App\Http\Controllers\API\Catalog\CatWeekMonthController;
use App\Http\Controllers\API\Catalog\CatTimeUnitController;

use Illuminate\Support\Facades\Route;

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cat-currency', CatCurrencyController::class);
    Route::apiResource('cat-day', CatDayController::class);
    Route::apiResource('cat-month', CatMonthController::class);
    Route::apiResource('cat-week-month', CatWeekMonthController::class);
    Route::apiResource('cat-time-unit', CatTimeUnitController::class);
});
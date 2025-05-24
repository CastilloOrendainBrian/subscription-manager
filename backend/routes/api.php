<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/', [UserController::class, 'store']);
});

Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']); // Solo en este dispositivo
    Route::post('/logout-all', [AuthController::class, 'logoutAll']); // En todos los dispositivos

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
    });

    // Example routes for permissions
    Route::get('/read-data', function (Request $request) {
        if (! $request->user()->tokenCan('read')) {
            abort(403, 'Este token no tiene permiso para leer.');
        }
        return ['data' => 'Contenido de solo lectura'];
    });

    Route::post('/write-data', function (Request $request) {
        if (! $request->user()->tokenCan('create')) {
            abort(403, 'Este token no puede crear contenido.');
        }
        return ['message' => 'Contenido creado'];
    });

    Route::delete('/delete-data', function (Request $request) {
        if (! $request->user()->tokenCan('delete')) {
            abort(403, 'Este token no puede borrar contenido.');
        }
        return ['message' => 'Contenido eliminado'];
    });

});

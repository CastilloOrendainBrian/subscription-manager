<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

foreach (glob(__DIR__ . '/modules/*.php') as $routeFile) {
    require $routeFile;
}

// Public routes
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Example routes for permissions
    /* Route::get('/read-data', function (Request $request) {
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
    }); */

});

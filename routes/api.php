<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MonitorController;
use Illuminate\Support\Facades\Route;
use App\Models\Zone;
use App\Models\Location;
use Illuminate\Http\Request;

// Ruta para obtener todos los equipos
Route::get('/locations', [LocationController::class, 'index']);

// Ruta para actualizar la posición cuando arrastras en el mapa
Route::put('/locations/{id}/position', [LocationController::class, 'updatePosition']);

Route::put('/locations/{id}', function (Request $request, $id) {
    $loc = Location::findOrFail($id);
    $loc->update($request->all());
    return response()->json(['message' => 'Localización actualizada']);
});

Route::post('/locations', function (Request $request) {
    $loc = Location::create($request->all());
    return response()->json(['message' => 'Localización creada', 'location' => $loc]);
});

Route::delete('/locations/{id}', function ($id) {
    Location::destroy($id);
    return response()->json(['message' => 'Localización eliminada']);
});


// Ruta para subir la foto y procesarla
Route::post('/monitor/scan', [MonitorController::class, 'scan']);
Route::get('/mapa-completo', function () {
    return response()->json([
        'zones' => Zone::all(),
        'locations' => Location::all()
    ]);
});
Route::put('/zones/{id}', function (Request $request, $id) {
    $zone = Zone::findOrFail($id);
    $zone->update($request->all());
    return response()->json(['message' => 'Zona actualizada']);
});

Route::post('/zones', function (Request $request) {
    $zone = Zone::create($request->all());
    return response()->json(['message' => 'Zona creada', 'zone' => $zone]);
});

Route::delete('/zones/{id}', function ($id) {
    Zone::destroy($id);
    return response()->json(['message' => 'Zona eliminada']);
});
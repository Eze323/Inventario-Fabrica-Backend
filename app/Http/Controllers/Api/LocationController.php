<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// IMPORTANTE: Agregamos la referencia al modelo
use App\Models\Location; 
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Obtener todos los equipos para el mapa
    public function index()
    {
        // Ahora sí sabe qué es "Location"
        return response()->json(Location::all());
    }

    // Guardar la nueva posición X e Y cuando arrastras un equipo
    public function updatePosition(Request $request, $id)
    {
        // Buscamos el equipo por su ID (ej: 1159)
        $location = Location::findOrFail($id);

        $location->update([
            'x' => $request->x,
            'y' => $request->y
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Posición guardada en Supabase',
            'data' => $location
        ]);
    }
}
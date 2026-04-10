<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Http;

class MonitorController extends Controller
{
    public function scan(Request $request)
    {
        // 1. Validar que venga una imagen
        $request->validate(['foto' => 'required|image']);

        $image = $request->file('foto');
        $base64Image = base64_encode(file_get_contents($image));

        // 2. Llamada a Gemini
        $apiKey = env('GEMINI_API_KEY');
        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
            "contents" => [
                [
                    "parts" => [
                        ["text" => "Analiza esta grilla de monitoreo industrial. 
                                   Busca solo los cuadros que NO están en verde (Rojos o Naranjas). 
                                   Devuelve estrictamente un JSON con este formato: 
                                   [{\"name\": \"NOMBRE_MAQUINA\", \"status\": \"error\"}]. 
                                   Si no hay fallas, devuelve un array vacío []. 
                                   Ignora el texto que no sea nombre de máquina."],
                        ["inline_data" => ["mime_type" => "image/png", "data" => $base64Image]]
                    ]
                ]
            ]
        ]);

        $data = $response->json();
        
        // Limpiamos la respuesta (Gemini a veces manda markdown ```json ...)
        $rawJson = $data['candidates'][0]['content']['parts'][0]['text'] ?? '[]';
        $machinesWithIssues = json_decode(preg_replace('/```json|```/', '', $rawJson), true);

        // 3. Lógica de actualización en Supabase
        // Primero ponemos todas en 'ok' (o el estado por defecto)
        Location::query()->update(['is_monitored' => false]); 

        // Marcamos las que Gemini detectó con problemas
        foreach ($machinesWithIssues as $issue) {
    // updateOrCreate busca por nombre, si no existe la crea
    Location::updateOrCreate(
        ['name' => $issue['name']], 
        [
            'is_monitored' => true,
            // Si es nueva, le ponemos valores por defecto
            'area' => $issue['area'] ?? 'DESCONOCIDO', 
            'x' => 0, 
            'y' => 0
        ]
    );
}

        return response()->json([
    'message' => 'Sincronización completada',
    'raw_from_gemini' => $machinesWithIssues, // Agregá esto para debug
]);
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function analizarFotoMonitor($rutaImagen)
    {
        $apiKey = config('services.gemini.key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

        // Convertimos la imagen a Base64
        $imageData = base64_encode(file_get_contents($rutaImagen));

        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => "Analizá esta imagen de un monitor de fábrica. Identificá todos los cuadros que NO estén en verde (rojos o naranjas). Devolvé un JSON con una lista de los nombres de las máquinas y su estado (falla o advertencia). Solo el JSON, sin texto extra."],
                        [
                            "inline_data" => [
                                "mime_type" => "image/png",
                                "data" => $imageData
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::post($url, $payload);
        return $response->json();
    }
}
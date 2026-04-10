<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Location;
use App\Models\Zone;

$zones = Zone::all();
$locations = Location::all();

$zoneMapping = [
    'BANBURY' => 'Banbury',
    'ARMADO' => 'Armado',
    'TALONES' => 'Talones',
    'SEMIELEBORADOS' => 'Semielaborados',
    'CFI' => 'CFI (Instr.)',
    'CFV' => 'CFV (Visual)',
    'CONTROL' => 'Control', // Se ubica aquí
    'TOOLS' => 'Oficina Tools',
];

// Mapeo inverso de id de zona a zona
$zoneByName = [];
foreach ($zones as $z) {
    // Si nombre tiene espacios, lo comparamos limpio
    $name = strtoupper(explode(' ', $z->name)[0]); 
    // Guardamos las zonas completas referenciadas por nombre parseado
    $zoneByName[$z->name] = $z;
}

// Variables para organizar la cuadricula de cada zona
$zoneCounters = [];

foreach ($locations as $loc) {
    if (empty($loc->area)) continue;

    $targetZoneName = null;
    
    // Matcheamos con el mapa estatico
    if (array_key_exists(strtoupper($loc->area), $zoneMapping) && $zoneMapping[strtoupper($loc->area)] !== null) {
        $targetZoneName = $zoneMapping[strtoupper($loc->area)];
    } else {
        // Fallback de parseo dinamico
        foreach ($zones as $z) {
            if (str_contains(strtoupper($z->name), strtoupper($loc->area))) {
                $targetZoneName = $z->name;
                break;
            }
        }
    }

    if ($targetZoneName && isset($zoneByName[$targetZoneName])) {
        $zone = $zoneByName[$targetZoneName];
        
        if (!isset($zoneCounters[$targetZoneName])) {
            $zoneCounters[$targetZoneName] = 0;
        }

        $count = $zoneCounters[$targetZoneName]++;
        
        // El equipo mide 60x30 en FactoryMap.vue
        // Podemos ponerlos en grilla sumando X y Y
        $cols = floor(($zone->w - 20) / 70); // Asumiendo margen
        if ($cols < 1) $cols = 1;
        
        $row = floor($count / $cols);
        $col = $count % $cols;

        $newX = $zone->x + 10 + ($col * 70);
        $newY = $zone->y + 30 + ($row * 40);

        // Asegurarnos que no se salgan del mapa (1250x750)
        $newX = min($newX, 1250 - 65);
        $newY = min($newY, 750 - 35);

        // Asegurarnos que NO se salgan del borde inferior ni derecho de su Zona
        $newX = min($newX, $zone->x + $zone->w - 65);
        $newY = min($newY, $zone->y + $zone->h - 35);

        // Actualizamos en la DB
        $loc->update([
            'x' => $newX,
            'y' => $newY
        ]);
        
        echo "Movido {$loc->name} ({$loc->area}) a la zona {$zone->name} => X:{$newX}, Y:{$newY}\n";
    } else {
        echo "No se encontró zona para el área: {$loc->area} (Equipo: {$loc->name})\n";
    }
}
echo "¡Proceso terminado!\n";

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('zones')->truncate();

        $zones = [
            ['id' => 'zn_01', 'name' => 'Materia Prima',  'x' => 10,  'y' => 10,  'w' => 250, 'h' => 150, 'color' => '#475569'], // Slate
            ['id' => 'zn_02', 'name' => 'Banbury',        'x' => 10,  'y' => 170, 'w' => 250, 'h' => 200, 'color' => '#dc2626'], // Rojo
            ['id' => 'zn_03', 'name' => 'Talones',        'x' => 270, 'y' => 10,  'w' => 200, 'h' => 200, 'color' => '#d97706'], // Ámbar
            ['id' => 'zn_04', 'name' => 'Armado',         'x' => 270, 'y' => 220, 'w' => 200, 'h' => 250, 'color' => '#2563eb'], // Azul
            ['id' => 'zn_05', 'name' => 'Semielaborados', 'x' => 480, 'y' => 10,  'w' => 350, 'h' => 250, 'color' => '#059669'], // Esmeralda
            ['id' => 'zn_06', 'name' => 'CFI (Instr.)',   'x' => 480, 'y' => 270, 'w' => 170, 'h' => 200, 'color' => '#7c3aed'], // Violeta
            ['id' => 'zn_07', 'name' => 'CFV (Visual)',   'x' => 660, 'y' => 270, 'w' => 170, 'h' => 200, 'color' => '#db2777']  // Rosa
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Juan Carlos Pérez', 'email' => 'juan.perez@gmail.com', 'address' => 'Av. Mitre 1420, Moreno', 'phone' => '11-3456-7890'],
            ['name' => 'María Elena Rodríguez', 'email' => 'maria.rodriguez@hotmail.com', 'address' => 'España 450, Paso del Rey', 'phone' => '11-2345-6789'],
            ['name' => 'Carlos Alberto Gómez', 'email' => 'carlos.gomez@yahoo.com', 'address' => 'Bme. Mitre 2300, Moreno', 'phone' => '11-5678-1234'],
            ['name' => 'Ana María Silva', 'email' => 'ana.silva@outlook.com', 'address' => 'Victorica 850, Moreno', 'phone' => '11-9876-5432'],
            ['name' => 'Diego Fernando Maradona', 'email' => 'diego.fernando@gmail.com', 'address' => 'J. M. de Rosas 1100, Trujui', 'phone' => '11-6543-2109'],
            ['name' => 'Patricia Noemí Fernández', 'email' => 'patricia.f@live.com.ar', 'address' => 'Asconapé 320, Moreno', 'phone' => '11-4444-5555'],
            ['name' => 'Jorge Omar González', 'email' => 'jorge.gonzalez@gmail.com', 'address' => 'Alcorta 2150, Francisco Álvarez', 'phone' => '11-8888-9999'],
            ['name' => 'Sonia Beatriz Martínez', 'email' => 'sonia.bm@gmail.com', 'address' => 'Piovano 4100, La Reja', 'phone' => '11-2222-3333'],
            ['name' => 'Luis Miguel Castro', 'email' => 'luis.castro@hotmail.com', 'address' => 'Graham Bell 1200, Paso del Rey', 'phone' => '11-7777-6666'],
            ['name' => 'Elena Beatriz López', 'email' => 'elena.lopez@yahoo.com.ar', 'address' => 'Storni 540, La Reja', 'phone' => '11-3333-1111'],
            ['name' => 'Mariano Javier Díaz', 'email' => 'mariano.diaz@gmail.com', 'address' => 'Colectora Norte Km 38, Moreno', 'phone' => '11-5555-4444'],
            ['name' => 'Clara Inés Romero', 'email' => 'clara.romero@gmail.com', 'address' => 'Libertador 730, Moreno', 'phone' => '11-1234-5678'],
            ['name' => 'Roberto Carlos Sánchez', 'email' => 'roberto.sanchez@outlook.com', 'address' => 'Nemecio Álvarez 140, Francisco Álvarez', 'phone' => '11-8765-4321'],
            ['name' => 'Silvia Marcela Torres', 'email' => 'silvia.torres@hotmail.com', 'address' => 'Márquez de Aguado 2200, Trujui', 'phone' => '11-2468-1357'],
            ['name' => 'Gustavo Adrián Cerati', 'email' => 'gustavo.cerati@gmail.com', 'address' => 'Uruguay 150, Moreno Centro', 'phone' => '11-1357-2468'],
            ['name' => 'Alicia Mabel Benítez', 'email' => 'alicia.b@live.com', 'address' => 'Padre Fahy 1800, La Reja', 'phone' => '11-9632-5874'],
            ['name' => 'Walter Adrián Samuel', 'email' => 'walter.samuel@gmail.com', 'address' => 'Zeballos 640, Moreno', 'phone' => '11-7412-5896'],
            ['name' => 'Florencia Magalí Acosta', 'email' => 'flor.acosta@gmail.com', 'address' => 'Belgrano 480, Paso del Rey', 'phone' => '11-8520-1479'],
            ['name' => 'Ricardo Alberto Darín', 'email' => 'ricardo.darin@yahoo.com', 'address' => 'Tulissi 1350, Francisco Álvarez', 'phone' => '11-3698-5214'],
            ['name' => 'Marta Susana Giménez', 'email' => 'marta.susana@gmail.com', 'address' => 'Demóstenes 3100, Cuartel V', 'phone' => '11-1478-5236'],
        ];

        foreach ($customers as $customer) {
            DB::table('customers')->insert([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'address' => $customer['address'],
                'phone' => $customer['phone'],
            ]);
        }
    }
}


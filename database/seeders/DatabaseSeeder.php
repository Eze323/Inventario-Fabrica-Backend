<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear Usuarios
        $password = 'password123';

        User::updateOrCreate(
            ['email' => 'administrador@vivero.com'],
            [
                'name' => 'Ezequiel',
                'password' => $password,
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'encargado@vivero.com'],
            [
                'name' => 'Encargado',
                'password' => $password,
                'role' => 'encargado',
            ]
        );

        User::updateOrCreate(
            ['email' => 'operario@vivero.com'],
            [
                'name' => 'Operario',
                'password' => $password,
                'role' => 'operario',
            ]
        );

        // 2. Crear Productos (Plantas de ejemplo)
        $productos = [
            [
                'name' => 'Monstera Deliciosa',
                'category' => 'Plantas de Interior',
                'description' => 'Planta de hojas grandes y perforadas, ideal para interiores.',
                'precio_compra' => 1500.00,
                'precio_venta' => 3500.00,
                'stock' => 20,
                'pot_size' => 'M',
                'publicado' => true,
                'sku' => 'PL-INT-MON-01'
            ],
            [
                'name' => 'Ficus Lyrata',
                'category' => 'Plantas de Interior',
                'description' => 'Planta elegante con hojas en forma de violín.',
                'precio_compra' => 2000.00,
                'precio_venta' => 4500.00,
                'stock' => 15,
                'pot_size' => 'L',
                'publicado' => true,
                'sku' => 'PL-INT-FIC-01'
            ],
            [
                'name' => 'Suculenta Echeveria',
                'category' => 'Suculentas',
                'description' => 'Pequeña suculenta en forma de roseta.',
                'precio_compra' => 300.00,
                'precio_venta' => 800.00,
                'stock' => 50,
                'pot_size' => 'S',
                'publicado' => true,
                'sku' => 'SUC-ECH-01'
            ],
            [
                'name' => 'Pothos (Potus)',
                'category' => 'Plantas Colgantes',
                'description' => 'Planta colgante muy resistente y fácil de cuidar.',
                'precio_compra' => 800.00,
                'precio_venta' => 2000.00,
                'stock' => 30,
                'pot_size' => 'M',
                'publicado' => true,
                'sku' => 'PL-COL-POT-01'
            ]
        ];

        foreach ($productos as $producto) {
            Product::firstOrCreate(
                ['sku' => $producto['sku']],
                $producto
            );
        }
    }
}

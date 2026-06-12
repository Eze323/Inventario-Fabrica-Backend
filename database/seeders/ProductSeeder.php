<?php
/* 
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /*public function run(): void
    {
        //
    }
}
*/



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // INTERIOR
            ['name' => 'Monstera Deliciosa', 'category' => 'Interior', 'pot_size' => 'M18', 'stock' => 15, 'precio_venta' => 4500.00],
            ['name' => 'Sansevieria (Espada de San Jorge)', 'category' => 'Interior', 'pot_size' => 'M14', 'stock' => 25, 'precio_venta' => 2200.00],
            ['name' => 'Potus Dorado', 'category' => 'Interior', 'pot_size' => 'M12 (Colgante)', 'stock' => 40, 'precio_venta' => 1500.00],
            ['name' => 'Ficus Pandurata', 'category' => 'Interior', 'pot_size' => 'M24', 'stock' => 8, 'precio_venta' => 8500.00],
            ['name' => 'Guzmania (Bromelia)', 'category' => 'Interior', 'pot_size' => 'M14', 'stock' => 12, 'precio_venta' => 3100.00],
            ['name' => 'Zamioculca', 'category' => 'Interior', 'pot_size' => 'M16', 'stock' => 10, 'precio_venta' => 5200.00],
            ['name' => 'Spatifilium (Cuna de Moisés)', 'category' => 'Interior', 'pot_size' => 'M14', 'stock' => 18, 'precio_venta' => 2400.00],
            ['name' => 'Calathea Triostar', 'category' => 'Interior', 'pot_size' => 'M14', 'stock' => 14, 'precio_venta' => 3500.00],

            // EXTERIOR / JARDÍN
            ['name' => 'Malvón Pensamiento', 'category' => 'Exterior', 'pot_size' => 'M12', 'stock' => 50, 'precio_venta' => 950.00],
            ['name' => 'Rosal Arbustivo', 'category' => 'Exterior', 'pot_size' => '4 Litros', 'stock' => 20, 'precio_venta' => 3800.00],
            ['name' => 'Lavanda Angustifolia', 'category' => 'Exterior', 'pot_size' => 'M14', 'stock' => 35, 'precio_venta' => 1400.00],
            ['name' => 'Hortensia', 'category' => 'Exterior', 'pot_size' => '3 Litros', 'stock' => 15, 'precio_venta' => 4200.00],
            ['name' => 'Jasmin del País', 'category' => 'Exterior', 'pot_size' => '4 Litros', 'stock' => 10, 'precio_venta' => 3600.00],
            ['name' => 'Agapanthus Azul', 'category' => 'Exterior', 'pot_size' => 'M18', 'stock' => 30, 'precio_venta' => 1900.00],
            ['name' => 'Dietes Bicolor', 'category' => 'Exterior', 'pot_size' => 'M14', 'stock' => 25, 'precio_venta' => 1600.00],
            ['name' => 'Buxus Sempervirens', 'category' => 'Exterior', 'pot_size' => '3 Litros', 'stock' => 22, 'precio_venta' => 2700.00],

            // ARBUSTOS Y ÁRBOLES
            ['name' => 'Acer Palmatum (Arce Japonés)', 'category' => 'Árboles', 'pot_size' => '7 Litros', 'stock' => 5, 'precio_venta' => 18500.00],
            ['name' => 'Limonero de las Cuatro Estaciones', 'category' => 'Frutales', 'pot_size' => '10 Litros', 'stock' => 12, 'precio_venta' => 9500.00],
            ['name' => 'Eugenia Myrtifolia', 'category' => 'Arbustos', 'pot_size' => '5 Litros', 'stock' => 40, 'precio_venta' => 3200.00],
            ['name' => 'Oleatexana Variegada', 'category' => 'Arbustos', 'pot_size' => '4 Litros', 'stock' => 18, 'precio_venta' => 2900.00],
            ['name' => 'Olive (Olivo)', 'category' => 'Árboles', 'pot_size' => '15 Litros', 'stock' => 4, 'precio_venta' => 14000.00],

            // SUCULENTAS Y CACTUS
            ['name' => 'Echeveria Elegans', 'category' => 'Suculentas', 'pot_size' => 'M10', 'stock' => 60, 'precio_venta' => 650.00],
            ['name' => 'Cactus Asiento de Suegra', 'category' => 'Cactus', 'pot_size' => 'M14', 'stock' => 15, 'precio_venta' => 2800.00],
            ['name' => 'Aloe Vera', 'category' => 'Suculentas', 'pot_size' => 'M14', 'stock' => 30, 'precio_venta' => 1200.00],
            ['name' => 'Crassula Ovata (Árbol de Jade)', 'category' => 'Suculentas', 'pot_size' => 'M12', 'stock' => 45, 'precio_venta' => 980.00],

            // AROMÁTICAS
            ['name' => 'Romero Rastrero', 'category' => 'Aromáticas', 'pot_size' => 'M12', 'stock' => 30, 'precio_venta' => 850.00],
            ['name' => 'Salvia Officinalis', 'category' => 'Aromáticas', 'pot_size' => 'M12', 'stock' => 20, 'precio_venta' => 850.00],
            ['name' => 'Mentha Piperita', 'category' => 'Aromáticas', 'pot_size' => 'M12', 'stock' => 25, 'precio_venta' => 700.00],

            // HUERTA Y VARIOS
            ['name' => 'Plantín de Tomate Platense', 'category' => 'Huerta', 'pot_size' => 'Plantín', 'stock' => 100, 'precio_venta' => 400.00],
            ['name' => 'Helecho Serrucho', 'category' => 'Exterior', 'pot_size' => 'M18 (Colgante)', 'stock' => 16, 'precio_venta' => 2900.00],
        ];

        foreach ($products as $index => $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'category' => $product['category'],
                'description' => 'Ejemplar de ' . $product['name'] . ' ideal para decoración de ' . strtolower($product['category']) . '. Excelente sanidad.',
                'precio_compra' => round($product['precio_venta'] * 0.5, 2), // Calcula costo estimado al 50%
                'precio_venta' => $product['precio_venta'],
                'stock' => $product['stock'],
                'pot_size' => $product['pot_size'],
                'image_url' => null,
                'publicado' => true,
                'sku' => 'VIV-' . strtoupper(Str::slug(substr($product['name'], 0, 4))) . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener los datos reales de la base para poder relacionar
        $users = DB::table('users')->get();
        $customers = DB::table('customers')->get();
        $products = DB::table('products')->get();

        // Validación rápida por si las dudas
        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->error('Faltan usuarios o productos en la base de datos para generar ventas.');
            return;
        }

        // Estados posibles para las ventas de un vivero/fábrica
        $statuses = ['Completada', 'Completada', 'Completada', 'Pendiente', 'Cancelada'];

        // Generar 20 ventas
        for ($i = 1; $i <= 20; $i++) {
            // Seleccionar usuario/vendedor, cliente y estado al azar
            $randomUser = $users->random();
            
            // Un 15% de las ventas pueden ser a consumidor final (sin cliente registrado)
            $isWalkInCustomer = rand(1, 100) <= 15;
            $randomCustomer = (!$isWalkInCustomer && $customers->isNotEmpty()) ? $customers->random() : null;

            $status = $statuses[array_rand($statuses)];
            
            // Generar fechas aleatorias de los últimos 30 días
            $randomDate = Carbon::now()->subDays(rand(0, 30));

            // Insertar la cabecera de la venta
            $saleId = DB::table('sales')->insertGetId([
                'user_id' => $randomUser->id,
                'customer_id' => $randomCustomer ? $randomCustomer->id : null,
                'customer' => $randomCustomer ? $randomCustomer->name : 'Consumidor Final',
                'email' => $randomCustomer ? $randomCustomer->email : null,
                'seller' => $randomUser->name,
                'date' => $randomDate->format('Y-m-d'),
                'time' => $randomDate->format('H:i:s'),
                'status' => $status,
                'total_price' => 0, // Lo calculamos y actualizamos abajo
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);

            // Determinar cuántos productos va a tener esta venta (entre 3 y 10)
            $itemsCount = rand(3, 10);
            
            // Mezclamos los productos disponibles para no repetir el mismo en la misma venta
            $shuffledProducts = $products->shuffle()->take($itemsCount);
            
            $saleTotal = 0;

            // Insertar los ítems de la venta
            foreach ($shuffledProducts as $product) {
                $quantity = rand(1, 5); // Cantidad comprada de este producto (entre 1 y 5 macetas/unidades)
                $unitPrice = $product->precio_venta;
                $subtotal = $unitPrice * $quantity;
                
                $saleTotal += $subtotal;

                DB::table('sale_items')->insert([
                    'sale_id' => $saleId,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);
            }

            // Actualizar el precio total real en la cabecera de la venta
            DB::table('sales')->where('id', $saleId)->update([
                'total_price' => $saleTotal
            ]);
        }
    }
}

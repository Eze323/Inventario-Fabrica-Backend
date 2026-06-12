<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Trae todas las ventas con sus ítems y el nombre del producto de cada ítem.
     */
    public function index()
    {
        // 💡 Acá está el secreto: cargamos la relación anidada para tener el nombre de la planta
        $sales = Sale::with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($sales);
    }

    /**
     * Guarda una nueva venta (Online) y descuenta el stock.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required|string',
            'address' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.productId' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unitPrice' => 'required|numeric',
        ]);

        try {
            $result = DB::transaction(function () use ($request) {
                // 1. Crear la Venta
                $sale = Sale::create([
                    'customer' => $request->customer,
                    'address' => $request->address,
                    'subtotal' => $request->subtotal,
                    'iva' => $request->iva,
                    'total' => $request->total,
                ]);

                // 2. Crear los ítems y actualizar stock de plantas
                foreach ($request->items as $item) {
                    $sale->items()->create([
                        'product_id' => $item['productId'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unitPrice'],
                    ]);

                    // Opcional: Descontar del stock de la tabla Product
                    $product = \App\Models\Product::find($item['productId']);
                    if ($product) {
                        $product->decrement('stock', $item['quantity']);
                    }
                }

                return $sale->load('items.product');
            });

            return response()->json([
                'success' => true,
                'message' => 'Venta guardada con éxito',
                'data' => $result
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la venta',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
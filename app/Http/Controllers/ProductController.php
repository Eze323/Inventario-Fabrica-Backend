<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Listar todos los productos.
     */
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Obtener un producto específico por ID.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Crear un nuevo producto (con validación estricta).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'nullable|string|max:100',
            'description'   => 'nullable|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'pot_size'      => 'nullable|string|max:50', // Ej: "M12", "10 Litros"
            'image_url'     => 'nullable|string',
            'publicado'     => 'nullable|boolean',
            'sku'           => 'nullable|string|unique:products,sku|max:100',
        ]);

        // Por defecto, si no viene 'publicado', lo seteamos en true
        if (!isset($validated['publicado'])) {
            $validated['publicado'] = true;
        }

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado con éxito',
            'data' => $product
        ], 201);
    }

    /**
     * Actualizar un producto existente.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'sometimes|required|string|max:255',
            'category'      => 'nullable|string|max:100',
            'description'   => 'nullable|string',
            'precio_compra' => 'sometimes|required|numeric|min:0',
            'precio_venta'  => 'sometimes|required|numeric|min:0',
            'stock'         => 'sometimes|required|integer|min:0',
            'pot_size'      => 'nullable|string|max:50',
            'image_url'     => 'nullable|string',
            'publicado'     => 'nullable|boolean',
            'sku'           => 'nullable|string|max:100|unique:products,sku,' . $product->id, // Ignora el SKU de este mismo producto al editar
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado con éxito',
            'data' => $product
        ]);
    }

    /**
     * Eliminar un producto.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Opcional: Podrías verificar si el producto tiene ventas asociadas antes de borrar
        if ($product->saleItems()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar el producto porque ya tiene ventas registradas. Te conviene despublicarlo.'
            ], 400);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado con éxito'
        ]);
    }
}

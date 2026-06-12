<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MonitorController;
use Illuminate\Support\Facades\Route;
use App\Models\Zone;
use App\Models\Location;
use App\Models\User;
use App\Models\Sale;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



// Ruta para obtener todos los equipos
Route::get('/locations', [LocationController::class, 'index']);

// Ruta para actualizar la posición cuando arrastras en el mapa
Route::put('/locations/{id}/position', [LocationController::class, 'updatePosition']);

Route::put('/locations/{id}', function (Request $request, $id) {
    $loc = Location::findOrFail($id);
    $loc->update($request->all());
    return response()->json(['message' => 'Localización actualizada']);
});

Route::post('/locations', function (Request $request) {
    $loc = Location::create($request->all());
    return response()->json(['message' => 'Localización creada', 'location' => $loc]);
});

Route::delete('/locations/{id}', function ($id) {
    Location::destroy($id);
    return response()->json(['message' => 'Localización eliminada']);
});


// Ruta para subir la foto y procesarla
Route::post('/monitor/scan', [MonitorController::class, 'scan']);
Route::get('/mapa-completo', function () {
    return response()->json([
        'zones' => Zone::all(),
        'locations' => Location::all()
    ]);
});
Route::put('/zones/{id}', function (Request $request, $id) {
    $zone = Zone::findOrFail($id);
    $zone->update($request->all());
    return response()->json(['message' => 'Zona actualizada']);
});

Route::post('/zones', function (Request $request) {
    $zone = Zone::create($request->all());
    return response()->json(['message' => 'Zona creada', 'zone' => $zone]);
});

Route::delete('/zones/{id}', function ($id) {
    Zone::destroy($id);
    return response()->json(['message' => 'Zona eliminada']);
});

// Autenticación (Login / Registro / Sesión)
Route::prefix('auth')->group(function () {
    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user
        ], 201);
    });

    Route::post('/login', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user
        ]);
    });

    Route::post('/logout', function (Request $request) {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }
        return response()->json(['message' => 'Sesión cerrada']);
    });

    Route::post('/refresh', function (Request $request) {
        // En una implementación real, se revocaría el token y se daría uno nuevo.
        // Por simplicidad, devolvemos el usuario actual si existe.
        return response()->json([
            'message' => 'Token renovado',
            'user' => $request->user(),
            'token' => $request->bearerToken()
        ]);
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});

// Rutas de Productos
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);






// Rutas de Usuarios
Route::get('/users', function () {
    return response()->json([
        'success' => true,
        'data' => \App\Models\User::all()
    ]);
});

// 1. Obtener todas las ventas (con sus ítems)
// Route::get('/sales', function () {
//     // Devolvemos directamente el array/objeto para que Nuxt lo tome limpio
//     return response()->json([
//         'success' => true,
//         'data' => \App\Models\Sale::with('items')->latest()->get()
//     ]);
// });

// 2. Obtener una sola venta por ID
// Route::get('/sales/{id}', function ($id) {
//     return response()->json([
//         'success' => true,
//         'data' => \App\Models\Sale::with('items')->findOrFail($id)
//     ]);
// });

// 3. Crear una nueva venta (Para cuando uses 'createSale' en Nuxt)
// Route::post('/sales', function (Request $request) {
//     // Validar los datos mínimos
//     $data = $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'customer' => 'required|string|max:255',
//         'status' => 'string',
//         'total_price' => 'required|numeric',
//     ]);

//     $sale = Sale::create($data);

//     return response()->json([
//         'success' => true,  
//         'message' => 'Venta registrada con éxito',
//         'sale' => $sale
//     ], 201);
// });

// 4. Actualizar una venta (Para 'updateSale')
// Route::put('/sales/{id}', function (Request $request, $id) {
//     $sale = Sale::findOrFail($id);
//     $sale->update($request->all());

//     return response()->json([
//         'success' => true,
//         'message' => 'Venta actualizada con éxito',
//         'sale' => $sale
//     ]);
// });

// 5. Eliminar una venta (Para 'deleteSale')
// Route::delete('/sales/{id}', function ($id) {
//     $sale = Sale::findOrFail($id);
//     $sale->delete();

//     return response()->json([
//         'success' => true,
//         'message' => 'Venta eliminada con éxito'
//     ]);
// });
Route::get('/sales', [SaleController::class, 'index']);
Route::post('/sales', [SaleController::class, 'store']);
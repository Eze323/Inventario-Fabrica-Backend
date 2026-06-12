<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class SaleItem extends Model
// {
//     use HasFactory;
// }
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    // Desactivamos timestamps porque esta tabla intermedia no los tiene
    public $timestamps = false;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price'
    ];

    // Un ítem pertenece a una venta
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    // Un ítem pertenece a un producto (para traer el nombre de la planta, etc.)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
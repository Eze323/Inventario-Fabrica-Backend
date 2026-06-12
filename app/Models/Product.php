<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'precio_compra',
        'precio_venta',
        'stock',
        'pot_size',
        'image_url',
        'publicado',
        'sku',
    ];

    /**
     * Un producto puede aparecer en muchos ítems de distintas ventas.
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'product_id');
    }
}
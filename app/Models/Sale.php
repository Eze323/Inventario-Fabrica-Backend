<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Sale extends Model
// {
 
// use HasFactory;
// }

// <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Campos que permitimos llenar en masa
    protected $fillable = [
        'user_id',
        'customer_id',
        'customer',
        'email',
        'seller',
        'date',
        'time',
        'status',
        'total_price'
    ];

    // Una venta tiene muchos ítems (detalles)
    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
}
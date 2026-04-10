<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //use HasFactory;
    protected $fillable = ['id', 'name', 'x', 'y', 'w', 'h', 'color'];
    
    // Configuraciones para IDs manuales (zn_01)
    public $incrementing = false;
    protected $keyType = 'string';
}

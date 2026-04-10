<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    // Permitir la actualización masiva de x e y
    protected $fillable = ['id', 'name', 'area', 'is_monitored', 'status', 'x', 'y'];
}

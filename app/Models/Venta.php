<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',

    ];

    // Si más adelante decides agregar relaciones con otros modelos, como los productos vendidos, puedes agregarlas aquí.
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['total'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_venta', 'venta_id', 'producto_id')
                    ->withPivot('cantidad', 'precio')
                    ->withTimestamps();
    }
}


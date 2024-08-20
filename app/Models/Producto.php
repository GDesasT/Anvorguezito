<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen_url', 'categoria'];

    public function scopeCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }
    
    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'hamburguesa_ingrediente', 'hamburguesa_id', 'ingrediente_id');
    }
}

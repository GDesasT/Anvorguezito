<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hamburguesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen_url',
    ];

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'hamburguesa_ingrediente');
    }
}

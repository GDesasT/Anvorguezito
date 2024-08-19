<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Hamburguesa;
use App\Models\Bebida;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        // Obtener productos (hamburguesas y bebidas)
        $productos = collect([
            ...Hamburguesa::all(),
            ...Bebida::all(),
        ]);

        // Pasar los productos a la vista pointofsale.blade.php
        return view('pointofsale', compact('productos'));
    }

    public function guardarVenta(Request $request)
    {
        // Guardar la venta en la base de datos
        $venta = Venta::create([
            'total' => $request->input('total'),
            'nombre_cliente' => $request->input('nombre_cliente'),
        ]);

        return redirect()->route('point_of_sale')->with('success', 'Venta registrada con éxito');
    }
}

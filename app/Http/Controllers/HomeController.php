<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function pointOfSale()
    {
        $productos = Producto::all(); // Obtiene todos los productos
        return view('pointofsale', compact('productos')); // Pasa los productos a la vista
    }
    public function login(){
        return view('login');
    }
}

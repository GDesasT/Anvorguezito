<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CarouselImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $images = CarouselImage::where('is_active', true)->get();
        return view('index', compact('images'));
    }
    public function pointOfSale()
    {
        $productos = Producto::all(); // Obtiene todos los productos
        return view('pointofsale', compact('productos')); // Pasa los productos a la vista
    }
    public function login(){
        return view('login');
    }
    public function history(){
        return view('history');
    }
}

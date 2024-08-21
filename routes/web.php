<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;

// Ruta para la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta para la vista del punto de venta
Route::get('/point-of-sale', [VentaController::class, 'create'])->name('point_of_sale');

// Ruta para la vista de login
Route::get('/login', [HomeController::class, 'login'])->name('login');

// Ruta para almacenar una venta
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');

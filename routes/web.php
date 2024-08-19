<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/PointOfSale', [HomeController::class, 'pointofsale'])->name('pointofsale');

Route::get('/PointOfSale', [VentaController::class, 'index'])->name('point_of_sale');
Route::post('/guardar_venta', [VentaController::class, 'guardarVenta'])->name('guardar_venta');

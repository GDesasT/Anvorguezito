<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesHistoryController extends Controller
{
    // Función para mostrar el historial de ventas con filtro de fecha y hora
    public function index(Request $request)
    {
        // Obtener las fechas de filtro si están presentes
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Crear la consulta base
        $query = Venta::query();

        // Aplicar el filtro de rango de fechas si se especifica
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Obtener las ventas filtradas
        $ventas = $query->with('productos')->get();

        // Calcular el total de ventas
        $totalVentas = $ventas->sum('total');

        return view('history', compact('ventas', 'totalVentas', 'startDate', 'endDate'));
    }

}

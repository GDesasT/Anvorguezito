<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class VentaController extends Controller
{
    // Método para mostrar el formulario de creación de una nueva venta
    public function create()
    {
        $productos = Producto::all();
        return view('pointofsale', compact('productos')); // Asegúrate de que la vista sea correcta
    }

    // Método para almacenar una nueva venta en la base de datos
    public function store(Request $request)
{
    $request->validate([
        'productos' => 'required|array',
        'productos.*.id' => 'required|exists:productos,id',
        'productos.*.quantity' => 'required|integer|min:1', // Verifica que uses 'quantity' si es el nombre en el frontend
    ]);

    DB::beginTransaction();

    try {
        $venta = new Venta();
        $venta->total = 0;
        $venta->save();

        foreach ($request->productos as $producto) {
            $productoModel = Producto::find($producto['id']);

            if ($productoModel) {
                $venta->productos()->attach($producto['id'], [
                    'cantidad' => $producto['quantity'],
                    'precio' => $productoModel->precio,
                ]);
                $venta->total += $productoModel->precio * $producto['quantity'];
            }
        }

        $venta->save();
        DB::commit();

        return response()->json(['success' => true], 200);
    } catch (Exception $e) {
        DB::rollBack();
        Log::error('Error al crear la venta: ' . $e->getMessage());

        return response()->json(['success' => false, 'message' => 'An error occurred while finalizing the order.'], 500);
    }
}


    // Método para mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::with('productos')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Método para mostrar los detalles de una venta específica
    public function show(Venta $venta)
    {
        $venta->load('productos');
        return view('ventas.show', compact('venta'));
    }

    // Método para eliminar una venta de la base de datos
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito');
    }
    public function salesHistory(Request $request)
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

    return view('ventas.history', compact('ventas', 'totalVentas', 'startDate', 'endDate'));

}

}

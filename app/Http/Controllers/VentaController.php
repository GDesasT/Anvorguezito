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

        // Validación de los datos de entrada
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Iniciar una transacción para asegurarnos de que la venta y los productos se guarden correctamente
        DB::beginTransaction();

        try {
            // Crear la venta
            $venta = new Venta();
            $venta->total = 0; // Inicializa el total en 0
            $venta->save();

            // Añadir productos a la venta
            foreach ($request->productos as $producto) {
                $productoModel = Producto::find($producto['id']);
                
                if ($productoModel) {
                    $venta->productos()->attach($producto['id'], [
                        'cantidad' => $producto['cantidad'],
                        'precio' => $productoModel->precio,
                    ]);

                    // Sumar al total de la venta
                    $venta->total += $productoModel->precio * $producto['cantidad'];
                }
            }

            // Actualiza el total después de añadir los productos
            $venta->save();

            // Confirmar la transacción
            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Registrar el error para el diagnóstico
            Log::error('Error al crear la venta: ' . $e->getMessage());

            // Devolver una respuesta de error
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
}

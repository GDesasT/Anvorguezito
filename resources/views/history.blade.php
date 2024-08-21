@extends('layouts.app')

@section('content')
<div class="container px-5 mx-auto bg-white">
    <h2 class="mb-6 text-2xl font-bold">Historial de Ventas</h2>

    <!-- Formulario de filtro -->
    <form method="GET" action="{{ route('ventas.history') }}" class="mb-6">
        <div class="flex space-x-4">
            <div class="flex flex-col">
                <label for="start_date" class="text-sm font-semibold">Fecha y Hora de Inicio</label>
                <input type="datetime-local" id="start_date" name="start_date" value="{{ $startDate }}" class="p-2 border-gray-300 rounded-lg">
            </div>
            <div class="flex flex-col">
                <label for="end_date" class="text-sm font-semibold">Fecha y Hora de Fin</label>
                <input type="datetime-local" id="end_date" name="end_date" value="{{ $endDate }}" class="p-2 border-gray-300 rounded-lg">
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Mostrar el total de ventas -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold">Total de Ventas: <span class="text-green-600">{{ number_format($totalVentas, 2) }} MXN</span></h3>
    </div>

    <!-- Tabla de historial de ventas -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="text-sm leading-normal text-gray-600 bg-gray-200">
                    <th class="px-6 py-3 text-left">ID Venta</th>
                    <th class="px-6 py-3 text-left">Fecha y Hora</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Productos</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-600">
                @foreach($ventas as $venta)
                <tr class="border-b border-gray-300">
                    <td class="px-6 py-3">{{ $venta->id }}</td>
                    <td class="px-6 py-3">{{ $venta->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="px-6 py-3">{{ number_format($venta->total, 2) }} MXN</td>
                    <td class="px-6 py-3">
                        <ul>
                            @foreach($venta->productos as $producto)
                            <li>{{ $producto->nombre }} (Cantidad: {{ $producto->pivot->cantidad }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

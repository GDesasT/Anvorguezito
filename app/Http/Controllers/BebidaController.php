<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    public function index()
    {
        $bebidas = Bebida::all();
        return view('bebidas.index', compact('bebidas'));
    }

    public function create()
    {
        return view('bebidas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'imagen_url' => 'required|url',
        ]);

        Bebida::create($request->all());

        return redirect()->route('bebidas.index')->with('success', 'Bebida creada con éxito');
    }

    public function show(Bebida $bebida)
    {
        return view('bebidas.show', compact('bebida'));
    }

    public function edit(Bebida $bebida)
    {
        return view('bebidas.edit', compact('bebida'));
    }

    public function update(Request $request, Bebida $bebida)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'imagen_url' => 'required|url',
        ]);

        $bebida->update($request->all());

        return redirect()->route('bebidas.index')->with('success', 'Bebida actualizada con éxito');
    }

    public function destroy(Bebida $bebida)
    {
        $bebida->delete();

        return redirect()->route('bebidas.index')->with('success', 'Bebida eliminada con éxito');
    }
}

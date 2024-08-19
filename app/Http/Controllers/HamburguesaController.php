<?php

namespace App\Http\Controllers;

use App\Models\Hamburguesa;
use Illuminate\Http\Request;

class HamburguesaController extends Controller
{
    public function index()
    {
        $hamburguesas = Hamburguesa::all();
        return view('hamburguesas.index', compact('hamburguesas'));
    }

    public function create()
    {
        return view('hamburguesas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'imagen_url' => 'required|url',
        ]);

        Hamburguesa::create($request->all());

        return redirect()->route('hamburguesas.index')->with('success', 'Hamburguesa creada con éxito');
    }

    public function show(Hamburguesa $hamburguesa)
    {
        return view('hamburguesas.show', compact('hamburguesa'));
    }

    public function edit(Hamburguesa $hamburguesa)
    {
        return view('hamburguesas.edit', compact('hamburguesa'));
    }

    public function update(Request $request, Hamburguesa $hamburguesa)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'imagen_url' => 'required|url',
        ]);

        $hamburguesa->update($request->all());

        return redirect()->route('hamburguesas.index')->with('success', 'Hamburguesa actualizada con éxito');
    }

    public function destroy(Hamburguesa $hamburguesa)
    {
        $hamburguesa->delete();

        return redirect()->route('hamburguesas.index')->with('success', 'Hamburguesa eliminada con éxito');
    }
}

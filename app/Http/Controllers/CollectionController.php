<?php

namespace App\Http\Controllers;

use App\Models\Collection; // Importamos el modelo
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    // Mostrar lista de colecciones
    public function index()
    {
        $collections = Collection::all();
        return view('collections.index', compact('collections'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('collections.create');
    }

    // Guardar en base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:collections',
            'description' => 'nullable|string'
        ]);

        Collection::create($request->all());

        return redirect()->route('collections.index')->with('success', 'Colección / Saga registrada con éxito.');
    }
}
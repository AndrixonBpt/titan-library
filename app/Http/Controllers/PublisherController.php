<?php

namespace App\Http\Controllers;

use App\Models\Publisher; // Importamos el modelo
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    // lista de editoriales
    public function index()
    {
        $publishers = Publisher::all();
        return view('publishers.index', compact('publishers'));
    }

    // formulario para crear
    public function create()
    {
        return view('publishers.create');
    }

    // Guardar en base de datos
    public function store(Request $request)
    {
        // Validamos que el nombre sea obligatorio y no se repita
        $request->validate([
            'name' => 'required|string|max:255|unique:publishers',
            'website' => 'nullable|url',
            'description' => 'nullable|string'
        ]);

        Publisher::create($request->all());

        return redirect()->route('publishers.index')->with('success', 'Editorial registrada con éxito.');
    }
}

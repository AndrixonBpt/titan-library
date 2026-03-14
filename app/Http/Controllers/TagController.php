<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // Mostrar lista de etiquetas
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('tags.create');
    }

    // Guardar en base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags'
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.index')->with('success', 'Etiqueta registrada con éxito.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category; // Importamos el modelo
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Mostrar lista de categorías
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // 2. Mostrar formulario para crear
    public function create()
    {
        return view('categories.create');
    }

    // 3. Guardar en base de datos
    public function store(Request $request)
    {
        // Validamos que el nombre sea obligatorio y no se repita
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Categoría creada con éxito.');
    }
}
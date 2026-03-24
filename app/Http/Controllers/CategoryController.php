<?php

namespace App\Http\Controllers;

use App\Models\Category; // Importamos el modelo
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mostrar lista de categorías
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('categories.create');
    }

    // Guardar en base de datos
    public function store(Request $request)
    {
        // nombre  obligatorio y no se repite
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Categoría creada con éxito.');
    }
}
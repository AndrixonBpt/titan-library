<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Mostrar formulario de crear autor
    public function create()
    {
        return view('library.create_author');
    }

    // Guardar el autor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string'
        ]);

        Author::create($request->all());

        return redirect()->route('library.create')->with('success', 'AUTHOR_REGISTERED_SUCCESSFULLY');
    }
}

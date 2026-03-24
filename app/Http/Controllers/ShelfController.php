<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShelfController extends Controller
{
    // estanterías del usuario actual
    public function index()
    {
        // Traemos las estanterías del usuario logueado y contamos cuántos libros tiene cada una
        $shelves = Shelf::where('user_id', Auth::id())->withCount('books')->get();
        return view('shelves.index', compact('shelves'));
    }

    // Crear una nueva estantería
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Shelf::create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'WORKSPACE_CREATED: Estantería creada.');
    }

    // Ver los libros dentro de una estantería
    public function show($id)
    {
        $shelf = Shelf::where('user_id', Auth::id())->with('books.author')->findOrFail($id);
        return view('shelves.show', compact('shelf'));
    }

    // Agregar un libro a una estantería
    public function addBook(Request $request, $book_id)
    {
        $request->validate(['shelf_id' => 'required|exists:shelves,id']);
        
        $shelf = Shelf::where('user_id', Auth::id())->findOrFail($request->shelf_id);
        
        // Verificamos que el libro no esté ya en esa estantería para evitar errores
        if (!$shelf->books()->where('book_id', $book_id)->exists()) {
            $shelf->books()->attach($book_id); // Magia de Laravel: Conecta la relación N a M
            return back()->with('success', 'DATA_LINKED: Libro agregado a la estantería.');
        }

        return back()->with('error', 'ERROR: El archivo ya existe en este espacio.');
    }

    //Quitar un libro de la estantería
    public function removeBook($shelf_id, $book_id)
    {
        $shelf = Shelf::where('user_id', Auth::id())->findOrFail($shelf_id);
        $shelf->books()->detach($book_id); // Desconecta la relación
        
        return back()->with('success', 'DATA_UNLINKED: Libro removido.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    // --- GESTIÓN DE LIBROS ---

    // 1. LISTAR
    public function index()
    {
        $books = Book::with('author')->get();
        return view('library.index', compact('books'));
    }

    // 2. FORMULARIO CREAR
    public function create()
    {
        $authors = Author::all();
        return view('library.create', compact('authors'));
    }

    // 3. GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'isbn' => 'required',
            'published_year' => 'required|integer',
            'book_file' => 'required|mimes:pdf|max:10000'
        ]);

        $path = $request->file('book_file')->store('books', 'public');

        Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'isbn' => $request->isbn,
            'published_year' => $request->published_year,
            'file_path' => $path
        ]);

        return redirect()->route('library.index');
    }

    // 4. VER DETALLE
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return view('library.show', compact('book'));
    }

    // --- GESTIÓN DE AUTORES ---

    // 5. FORMULARIO DE AUTOR
    public function createAuthor()
    {
        return view('library.create_author');
    }

    // 6. GUARDAR AUTOR
    public function storeAuthor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string'
        ]);

        Author::create($request->all());

        // Redirigimos de vuelta al formulario de crear libros
        return redirect()->route('library.create')->with('success', 'AUTHOR_REGISTERED_SUCCESSFULLY');
    }

} 

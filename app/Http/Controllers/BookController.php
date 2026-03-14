<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Collection;
use App\Models\Tag;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos la consulta base con sus relaciones
        $query = Book::with(['author', 'category', 'publisher', 'bookmarks']);

        // 2. Aplicamos el filtro de BÚSQUEDA POR TÍTULO
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 3. Aplicamos el filtro de CATEGORÍA
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. Aplicamos el filtro de AUTOR
        if ($request->filled('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        // Ejecutamos la consulta final
        $books = $query->get();

        // Traemos las listas para los menús desplegables del filtro
        $categories = Category::all();
        $authors = Author::all();

        return view('library.index', compact('books', 'categories', 'authors')); 
    }


    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        $collections = Collection::all();
        $tags = Tag::all();
        
        return view('library.create', compact('authors', 'categories', 'publishers', 'collections', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'collection_id' => 'nullable|exists:collections,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'isbn' => 'required',
            'published_year' => 'required|integer',
            'book_file' => 'required|mimes:pdf|max:10000',
            // NUEVAS VALIDACIONES:
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' // Máximo 2MB para imágenes
        ]);

        // Guardar PDF
        $path = $request->file('book_file')->store('books', 'public');
        
        // Guardar Imagen de Portada (Si existe)
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        // Crear Libro
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description, // <-- Guardamos Descripción
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'publisher_id' => $request->publisher_id,
            'collection_id' => $request->collection_id,
            'isbn' => $request->isbn,
            'published_year' => $request->published_year,
            'file_path' => $path,
            'cover_image' => $coverPath             // <-- Guardamos Portada
        ]);

        // Sincronizar Etiquetas (Tags)
        if ($request->has('tags')) {
            $book->tags()->sync($request->tags);
        }

        return redirect()->route('library.index');
    }

    public function show($id)
    {
        $book = Book::with(['author', 'category', 'publisher', 'collection', 'tags', 'reviews.user'])->findOrFail($id);
        return view('library.show', compact('book'));
    }
}

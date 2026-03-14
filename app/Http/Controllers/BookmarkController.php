<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Función de Interruptor (Agregar / Quitar)
    public function toggle($book_id)
    {
        $user_id = Auth::id(); // Obtenemos el ID del usuario actual

        // Buscamos si ya guardó este libro antes
        $bookmark = Bookmark::where('user_id', $user_id)
                            ->where('book_id', $book_id)
                            ->first();

        if ($bookmark) {
            // Si ya existe, lo borramos (Lo quita de favoritos)
            $bookmark->delete();
            $mensaje = 'Libro removido de tu lista.';
        } else {
            // Si no existe, lo creamos (Lo agrega a favoritos)
            Bookmark::create([
                'user_id' => $user_id,
                'book_id' => $book_id
            ]);
            $mensaje = 'Libro guardado en tu lista.';
        }

        // Nos devuelve a la página anterior
        return back()->with('success', $mensaje);
    }

    // Mostrar la lista de favoritos del usuario
    public function index()
    {
        // Traemos los favoritos de este usuario, y cargamos la info del libro y su autor
        $bookmarks = Bookmark::with('book.author')
                             ->where('user_id', Auth::id())
                             ->get();
                             
                             
        return view('bookmarks.index', compact('bookmarks'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\DownloadLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function download(Request $request, $id)
    {
        // 1. Buscamos el libro
        $book = Book::findOrFail($id);

        // 2. Verificamos que realmente tenga un archivo
        if (!$book->file_path) {
            return back()->with('error', 'DATA_CORRUPTED: El archivo fuente no existe.');
        }

        // 3. Registramos la analítica (El "Tracker")
        DownloadLog::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'ip_address' => $request->ip() // Guardamos la IP del usuario
        ]);

        // 4. Forzamos la descarga del archivo (Ocultando la ruta real por seguridad)
        $rutaAbsoluta = storage_path('app/public/' . $book->file_path);
        
        return response()->download($rutaAbsoluta);
    }
}
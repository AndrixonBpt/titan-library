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
        // Buscamos el libro
        $book = Book::findOrFail($id);


        if (!$book->file_path) {
            return back()->with('error', 'DATA_CORRUPTED: El archivo fuente no existe.');
        }

        // 
        DownloadLog::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'ip_address' => $request->ip() // Guarda la IP del usuario
        ]);

        // Forzamos la descarga del archivo (Ocultando la ruta real por seguridad)
        $rutaAbsoluta = storage_path('app/public/' . $book->file_path);
        
        return response()->download($rutaAbsoluta);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    // 1. Mostrar todas las peticiones (SOLO ADMIN)
    public function index()
    {
        // Traemos todas las peticiones ordenadas por las más recientes, junto con los datos del usuario
        $requests = BookRequest::with('user')->orderBy('created_at', 'desc')->get();
        return view('requests.index', compact('requests'));
    }

    // 2. Mostrar formulario para pedir libro (USUARIOS)
    public function create()
    {
        return view('requests.create');
    }

    // 3. Guardar la petición en la base de datos (USUARIOS)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        BookRequest::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author_name' => $request->author_name,
            'notes' => $request->notes,
            'status' => 'pending' // Por defecto entra como 'pendiente'
        ]);

        return redirect()->route('library.index')->with('success', 'TRANSMISSION_SENT: Tu petición ha sido enviada al Bibliotecario.');
    }

    // 4. Actualizar el estado de la petición (SOLO ADMIN)
    public function update(Request $request, $id)
    {
        $bookRequest = BookRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,completed,rejected'
        ]);

        $bookRequest->update(['status' => $request->status]);

        return back()->with('success', 'STATUS_UPDATED: El ticket ha sido actualizado.');
    }
}
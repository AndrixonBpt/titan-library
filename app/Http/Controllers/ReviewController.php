<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Guardar o actualizar la reseña
    public function store(Request $request, $book_id)
    {
        // Validacion de la calificación sea obligatoria y entre 1 y 5
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        // updateOrCreate busca el registro. Si existe, lo actualiza. Si no, lo crea.
        Review::updateOrCreate(
            [
                'user_id' => Auth::id(), 
                'book_id' => $book_id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        return back()->with('success', 'TRANSMISSION_RECEIVED: Tu reseña ha sido registrada.');
    }

    // Borrar la reseña 
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id === Auth::id() || Auth::user()->role === 'bibliotecario') {
            $review->delete();
            return back()->with('success', 'RECORD_DELETED: Reseña eliminada.');
        }

        abort(403, 'ACCESO DENEGADO');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // 1. SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'comment'
    ];

    // 2. RELACIONES
    // Una Reseña fue escrita por UN Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una Reseña pertenece a UN Libro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

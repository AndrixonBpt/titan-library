<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    // SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'user_id',
        'book_id',
        'notes'
    ];

    // RELACIONES
    // Un Bookmark pertenece a UN Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un Bookmark pertenece a UN Libro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
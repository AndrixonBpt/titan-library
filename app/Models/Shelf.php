<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    // 1. SEGURIDAD
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_public'
    ];

    // 2. RELACIONES
    // Una estantería pertenece a UN Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una estantería tiene MUCHOS Libros (N a M)
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
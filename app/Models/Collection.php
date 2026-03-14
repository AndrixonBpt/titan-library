<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    // 1. SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'name',
        'description'
    ];

    // 2. RELACIONES: Una Colección tiene MUCHOS Libros
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

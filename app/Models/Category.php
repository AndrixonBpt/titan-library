<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 1. SEGURIDAD: Columnas permitidas para llenado masivo
    protected $fillable = [
        'name',
        'description'
    ];

    // 2. RELACIONES: Una Categoría tiene MUCHOS Libros
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    
}
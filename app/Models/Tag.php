<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // SEGURIDAD
    protected $fillable = [
        'name'
    ];

    // RELACIONES: Una Etiqueta pertenece a MUCHOS Libros (N a M)
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
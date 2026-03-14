<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    // 1. SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'name',
        'website',
        'description'
    ];

    // 2. RELACIONES: Una Editorial tiene MUCHOS Libros
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
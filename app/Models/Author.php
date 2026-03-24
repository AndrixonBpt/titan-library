<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // se llenan masivamente
    protected $fillable = ['name', 'biography'];

    // RELACIÓN: Un autor TIENE MUCHOS libros
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
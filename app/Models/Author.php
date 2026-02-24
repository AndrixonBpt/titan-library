<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // Permitimos que estos campos se llenen masivamente
    protected $fillable = ['name', 'biography'];

    // RELACIÓN: Un autor TIENE MUCHOS libros
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
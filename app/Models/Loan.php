<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_id', 'loan_date', 'return_date'];

    // RELACIÓN: El préstamo PERTENECE A un usuario
    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }

    // RELACIÓN: El préstamo PERTENECE A un libro
    public function book() 
    { 
        return $this->belongsTo(Book::class); 
    }
}
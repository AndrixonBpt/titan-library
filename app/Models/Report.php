<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'user_id',
        'book_id',
        'issue_type',
        'description',
        'status'
    ];

    // RELACIONES
    // Un reporte es creado por UN Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un reporte pertenece a UN Libro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
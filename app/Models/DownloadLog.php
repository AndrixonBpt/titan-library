<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    use HasFactory;

    // SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'user_id',
        'book_id',
        'ip_address'
    ];

    // RELACIONES
    // Un registro de descarga pertenece a UN Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un registro de descarga pertenece a UN Libro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
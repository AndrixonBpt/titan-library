<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    use HasFactory;

    // SEGURIDAD: Protegemos contra asignación masiva
    protected $fillable = [
        'user_id',
        'title',
        'author_name',
        'notes',
        'status'
    ];

    // RELACIONES
    // Una petición pertenece a UN Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

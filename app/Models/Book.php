<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // 1. SEGURIDAD: Columnas permitidas
    protected $fillable = [
        'title', 
        'isbn', 
        'published_year', 
        'file_path',
        'author_id',
        'category_id',    // NUEVO
        'publisher_id',   // NUEVO
        'collection_id',   // NUEVO
        'description',
        'cover_image'
    ];

    // --- 2. RELACIONES: PERTENECE A (1 a N) ---
    
    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    // --- 3. RELACIONES: MUCHOS A MUCHOS (N a M) ---
    
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function shelves() {
        return $this->belongsToMany(Shelf::class); // Estanterías de usuarios
    }

    // --- 4. RELACIONES: TIENE MUCHOS (1 a N) ---
    
    public function bookmarks() {
        return $this->hasMany(Bookmark::class); // Quién lo tiene en favoritos
    }

    public function reviews() {
        return $this->hasMany(Review::class); // Comentarios y estrellas
    }

    public function downloadLogs() {
        return $this->hasMany(DownloadLog::class); // Estadísticas de descarga
    }

    public function reports() {
        return $this->hasMany(Report::class); // Reportes de errores del PDF
    }
}
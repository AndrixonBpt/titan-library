<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
    {
        Schema::create('book_tag', function (Blueprint $table) {
            $table->id();
            
            // Conexión con el Libro (Si borras el libro, se borra esta conexión)
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            // Conexión con la Etiqueta (Si borras el tag, se borra esta conexión)
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_tag');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título divertido
            $table->string('isbn')->unique(); // Código único del libro
            
            // Conexión con Autores (Clave Foránea)
            // Si borras al autor, se borran sus libros (cascade)
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            
            $table->integer('published_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

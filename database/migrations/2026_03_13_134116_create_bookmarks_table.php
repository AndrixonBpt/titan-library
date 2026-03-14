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
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            
            // ¿Quién lo guarda? (Conexión con el Usuario)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // ¿Qué libro guarda? (Conexión con el Libro)
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            // Opcional: El usuario puede dejar una nota privada al guardarlo
            $table->string('notes')->nullable(); 
            
            $table->timestamps();

            // Un usuario no puede guardar el mismo libro 2 veces
            $table->unique(['user_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};

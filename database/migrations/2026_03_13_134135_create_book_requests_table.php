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
        Schema::create('book_requests', function (Blueprint $table) {
            $table->id();
            
            // ¿Quién hace la petición?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Datos del libro que solicita
            $table->string('title'); // Título del libro deseado
            $table->string('author_name')->nullable(); // Autor (opcional, por si no lo sabe)
            
            // Información extra que el usuario quiera agregar
            $table->text('notes')->nullable(); 
            
            // Estado del "Ticket" (pending, completed, rejected)
            $table->string('status')->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_requests');
    }
};

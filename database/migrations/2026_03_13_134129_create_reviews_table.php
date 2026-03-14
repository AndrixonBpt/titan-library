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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // ¿Quién escribe la reseña?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // ¿Sobre qué libro es?
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            // Calificación (Ej. 1 al 5)
            $table->integer('rating'); 
            
            // Comentario (Opcional, puede que solo quiera dejar las estrellas)
            $table->text('comment')->nullable(); 
            
            $table->timestamps();

            // REGLA DE ORO: Un usuario solo puede dejar UNA reseña por libro
            $table->unique(['user_id', 'book_id']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

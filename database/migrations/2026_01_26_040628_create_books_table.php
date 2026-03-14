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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->unique();
            $table->integer('published_year');
            $table->string('file_path')->nullable(); // El PDF
            
            // --- LLAVES FORÁNEAS (RELACIONES 1 a N) ---
            
            // Autor (Requerido)
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            
            // Categoría (Opcional, 'set null' significa que si borras la categoría, el libro no se borra, solo se queda sin categoría)
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            
            // Editorial (Opcional)
            $table->foreignId('publisher_id')->nullable()->constrained()->onDelete('set null');
            
            // Colección / Saga (Opcional)
            $table->foreignId('collection_id')->nullable()->constrained()->onDelete('set null');
            
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

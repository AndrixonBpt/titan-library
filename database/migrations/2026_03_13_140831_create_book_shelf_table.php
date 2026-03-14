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
        Schema::create('book_shelf', function (Blueprint $table) {
            $table->id();
            
            // Conexión con el Libro
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            // Conexión con la Estantería
            $table->foreignId('shelf_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();

            // REGLA: Un mismo libro no puede agregarse 2 veces a la MISMA estantería
            $table->unique(['book_id', 'shelf_id']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_shelf');
    }
};

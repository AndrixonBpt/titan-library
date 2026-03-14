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
        Schema::create('shelves', function (Blueprint $table) {
            $table->id();
            
            // ¿De quién es esta estantería?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Nombre de la estantería (Ej. "Para leer el fin de semana")
            $table->string('name'); 
            
            // Descripción opcional
            $table->text('description')->nullable();
            
            // Opcional: Para decidir si la estantería es pública o privada
            $table->boolean('is_public')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelves');
    }
};

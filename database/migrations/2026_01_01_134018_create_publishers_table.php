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
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            
            // Nombre de la editorial 
            $table->string('name')->unique(); 
            
            // Sitio web oficial (Opcional)
            $table->string('website')->nullable(); 
            
            // Breve descripción o país de origen (Opcional)
            $table->text('description')->nullable(); 
            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};

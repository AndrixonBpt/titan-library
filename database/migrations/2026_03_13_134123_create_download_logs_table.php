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
        Schema::create('download_logs', function (Blueprint $table) {
            $table->id();
            
            // ¿Quién lo descargó?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // ¿Qué libro descargó?
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            // Dato extra analítico: Podemos guardar la IP de donde se descargó (opcional pero muy Pro)
            $table->string('ip_address')->nullable(); 
            
            // created_at y updated_at automáticos (created_at nos dirá la fecha y hora exacta de la descarga)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_logs');
    }
};

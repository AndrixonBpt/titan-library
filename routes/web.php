<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\AuthController;
// Importamos nuestro nuevo guardián
use App\Http\Middleware\AdminMiddleware;

// 1. PÚBLICO
// Página de aterrizaje
Route::view('/', 'landing')->name('landing');

// Rutas de autenticación
// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Logout salida 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');


// 2. PRIVADO (Solo usuarios logueados)
Route::middleware(['auth'])->group(function () {
    
    // Todos (Lectores y Bibliotecarios) pueden ver:
    Route::get('/sistema', [LibraryController::class, 'index'])->name('library.index');
    Route::get('/sistema/ver/{id}', [LibraryController::class, 'show'])->name('library.show');

    // 3. SOLO BIBLIOTECARIOS (Protegido por AdminMiddleware)
    Route::middleware(AdminMiddleware::class)->group(function () {
         // Libros
        Route::get('/sistema/crear', [LibraryController::class, 'create'])->name('library.create');
        Route::post('/sistema/guardar', [LibraryController::class, 'store'])->name('library.store');
        // Autores 
        Route::get('/sistema/autor/crear', [LibraryController::class, 'createAuthor'])->name('library.createAuthor');
        Route::post('/sistema/autor/guardar', [LibraryController::class, 'storeAuthor'])->name('library.storeAuthor');
    });

    

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
// --- NUEVOS CONTROLADORES SOLID ---
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShelfController;




// 1. PÚBLICO
Route::view('/', 'landing')->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// 2. PRIVADO (Solo usuarios logueados)
Route::middleware(['auth'])->group(function () {
    
    // Todos pueden ver el catálogo de libros
    Route::get('/sistema', [BookController::class, 'index'])->name('library.index');
    Route::get('/sistema/ver/{id}', [BookController::class, 'show'])->name('library.show');
      // --- NUEVAS RUTAS: FAVORITOS ---
    Route::post('/favoritos/toggle/{book_id}', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::get('/mis-favoritos', [BookmarkController::class, 'index'])->name('bookmarks.index');

        // --- ESTANTERÍAS PERSONALIZADAS ---
    Route::get('/mis-estanterias', [ShelfController::class, 'index'])->name('shelves.index');
    Route::post('/mis-estanterias', [ShelfController::class, 'store'])->name('shelves.store');
    Route::get('/mis-estanterias/{id}', [ShelfController::class, 'show'])->name('shelves.show');
    Route::post('/mis-estanterias/agregar/{book_id}', [ShelfController::class, 'addBook'])->name('shelves.addBook');
    Route::delete('/mis-estanterias/{shelf_id}/quitar/{book_id}', [ShelfController::class, 'removeBook'])->name('shelves.removeBook');
    
        // --- NUEVAS RUTAS: RESEÑAS ---
    Route::post('/sistema/ver/{book_id}/resena', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/resenas/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
      // --- DESCARGA SEGURA ---
    Route::get('/sistema/descargar/{id}', [DownloadController::class, 'download'])->name('library.download');

        // --- PETICIONES DE LIBROS (USUARIOS) ---
    Route::get('/peticiones/nueva', [BookRequestController::class, 'create'])->name('requests.create');
    Route::post('/peticiones', [BookRequestController::class, 'store'])->name('requests.store');
      // --- REPORTAR LIBRO (USUARIOS) ---
    Route::post('/sistema/ver/{id}/reportar', [ReportController::class, 'store'])->name('reports.store');


    // 3. SOLO BIBLIOTECARIOS (Protegido por AdminMiddleware)
    Route::middleware(AdminMiddleware::class)->group(function () {
        
        // --- LIBROS ---
        Route::get('/sistema/crear', [BookController::class, 'create'])->name('library.create');
        Route::post('/sistema/guardar', [BookController::class, 'store'])->name('library.store');
        
        // --- AUTORES ---
        Route::get('/sistema/autor/crear', [AuthorController::class, 'create'])->name('library.createAuthor');
        Route::post('/sistema/autor/guardar', [AuthorController::class, 'store'])->name('library.storeAuthor');

        // --- CATEGORÍAS ---
        Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categorias/crear', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');

        // --- EDITORIALES ---
        Route::get('/editoriales', [PublisherController::class, 'index'])->name('publishers.index');
        Route::get('/editoriales/crear', [PublisherController::class, 'create'])->name('publishers.create');
        Route::post('/editoriales', [PublisherController::class, 'store'])->name('publishers.store');

                // --- COLECCIONES / SAGAS ---
        Route::get('/colecciones', [CollectionController::class, 'index'])->name('collections.index');
        Route::get('/colecciones/crear', [CollectionController::class, 'create'])->name('collections.create');
        Route::post('/colecciones', [CollectionController::class, 'store'])->name('collections.store');

                // --- ETIQUETAS / TAGS ---
        Route::get('/etiquetas', [TagController::class, 'index'])->name('tags.index');
        Route::get('/etiquetas/crear', [TagController::class, 'create'])->name('tags.create');
        Route::post('/etiquetas', [TagController::class, 'store'])->name('tags.store');

         // --- GESTIÓN DE PETICIONES (SOLO ADMIN) ---
        Route::get('/admin/peticiones', [BookRequestController::class, 'index'])->name('requests.index');
        Route::put('/admin/peticiones/{id}', [BookRequestController::class, 'update'])->name('requests.update');

                // --- GESTIÓN DE REPORTES (SOLO ADMIN) ---
        Route::get('/admin/reportes', [ReportController::class, 'index'])->name('reports.index');
        Route::put('/admin/reportes/{id}', [ReportController::class, 'update'])->name('reports.update');

                // --- CENTRO DE MANDO (DASHBOARD) ---
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

                // --- GESTIÓN DE USUARIOS ---
        Route::get('/admin/usuarios', [UserController::class, 'index'])->name('users.index');
        Route::put('/admin/usuarios/{id}/rol', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');



    });
});

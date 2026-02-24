<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body>

    <div class="container" style="max-width: 500px;">
        <header style="justify-content: center; border-bottom: none;">
            <h1>NUEVO REGISTRO</h1>
        </header>

<!-- Archivo: resources/views/library/create.blade.php -->

<!-- IMPORTANTE: El enctype es obligatorio para subir archivos -->
        <form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 30px;">
            @csrf
        
            <div style="margin-bottom: 24px;">
                <label>Título de la Obra</label>
                <input type="text" name="title" required placeholder="Ej. Manual de Laravel" autocomplete="off">
            </div>
        
            <div style="margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label>Autor Principal</label>
                    <!-- Enlace rápido para crear autor -->
                    <a href="{{ route('library.createAuthor') }}" style="font-size: 0.75rem; color: #a855f7; text-decoration: none; border: 1px solid #a855f7; padding: 2px 8px; border-radius: 4px;">
                        + NUEVO AUTOR
                    </a>
                </div>
                
                <select name="author_id" required>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

        
            <!-- NUEVO CAMPO: Archivo PDF -->
            <div style="margin-bottom: 24px; border: 1px dashed var(--border); padding: 15px; border-radius: 6px;">
                <label style="color: var(--accent);">Archivo Fuente (PDF)</label>
                <input type="file" name="book_file" accept=".pdf" required style="background: transparent; border: none; padding-left: 0;">
            </div>
        
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                <div>
                    <label>Año</label>
                    <input type="number" name="published_year" required placeholder="2024">
                </div>
                <div>
                    <label>Código ISBN</label>
                    <input type="text" name="isbn" required placeholder="000-00-000">
                </div>
            </div>
        
            <div style="display: flex; gap: 15px;">
                <a href="{{ route('library.index') }}" class="btn-primary" style="background: transparent; border: 1px solid var(--border); color: var(--text-secondary); text-align: center; width: 30%; display: flex; align-items: center; justify-content: center;">
                    CANCELAR
                </a>
                <button type="submit" class="btn-primary" style="width: 70%; font-weight: bold; letter-spacing: 1px;">
                    CONFIRMAR INGRESO
                </button>
            </div>
        </form>
  
    </div>

</body>
</html>
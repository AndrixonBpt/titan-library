<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedir Libro - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;">

    <div class="container" style="max-width: 500px; border-color: #a855f7; width: 100%; margin-top: 5vh;">
        <header style="border-bottom: 1px dashed #a855f7; padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="font-size: 1.5rem; margin: 0;">
                <span style="color: #a855f7;">[+]</span> REQUEST_BOOK
            </h1>
            <p style="color: #8b949e; font-size: 0.8rem; margin-top: 10px; font-family: monospace;">// Solicita material a la base de datos central</p>
        </header>

        <form action="{{ route('requests.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="color: #d8b4fe;">Título de la Obra (Requerido)</label>
                <input type="text" name="title" required placeholder="Ej. Cracking the Coding Interview" style="border-color: #7e22ce;">
            </div>
            
            <div style="margin-bottom: 24px;">
                <label style="color: #d8b4fe;">Autor (Opcional)</label>
                <input type="text" name="author_name" placeholder="Ej. Gayle Laakmann McDowell" style="border-color: #7e22ce;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="color: #d8b4fe;">Notas Adicionales (Opcional)</label>
                <textarea name="notes" rows="3" placeholder="¿Alguna edición en específico o idioma?" 
                    style="width: 100%; background: #09090b; border: 1px solid #7e22ce; color: #f4f4f5; padding: 12px; border-radius: 6px; font-family: inherit; margin-top: 6px;"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('library.index') }}" class="btn-outline" style="text-align: center; flex: 1;">CANCELAR</a>
                <button type="submit" class="btn-code" style="flex: 1; background-color: #a855f7; color: white; border-color: transparent;">ENVIAR PETICIÓN</button>
            </div>
        </form>
    </div>

</body>
</html>
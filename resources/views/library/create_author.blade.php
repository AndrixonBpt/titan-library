<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Autor - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body>

    <div class="container" style="max-width: 500px; border-color: #a855f7;"> <!-- Borde Púrpura para distinguir -->
        <header style="justify-content: center; border-bottom: 1px dashed #a855f7; padding-bottom: 20px;">
            <h1 style="font-size: 1.5rem;">
                <span style="color: #a855f7;">✚</span> NUEVO AUTOR
            </h1>
        </header>

        <form action="{{ route('library.storeAuthor') }}" method="POST" style="margin-top: 30px;">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="color: #d8b4fe;">Nombre Completo</label>
                <input type="text" name="name" required placeholder="Ej. Alan Turing" style="border-color: #581c87;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="color: #d8b4fe;">Biografía / Notas</label>
                <textarea name="biography" rows="4" placeholder="Datos relevantes del autor..." 
                    style="width: 100%; background: #09090b; border: 1px solid #581c87; color: #f4f4f5; padding: 12px; border-radius: 6px; font-family: inherit; margin-top: 6px;"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('library.create') }}" class="btn-primary" style="background: transparent; border: 1px solid #a855f7; color: #d8b4fe; text-align: center; flex: 1; display: flex; align-items: center; justify-content: center;">
                    VOLVER
                </a>
                <button type="submit" class="btn-primary" style="flex: 1; background-color: #a855f7; color: white;">
                    GUARDAR AUTOR
                </button>
            </div>
        </form>
    </div>

</body>
</html>
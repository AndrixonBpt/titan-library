<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Categoría - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;">

    <div class="container" style="max-width: 500px; border-color: #3b82f6; width: 100%; margin-top: 5vh;">
        <header style="border-bottom: 1px dashed #3b82f6; padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="font-size: 1.5rem; margin: 0;">
                <span style="color: #3b82f6;">✚</span> REGISTRAR CATEGORÍA
            </h1>
        </header>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="color: #93c5fd;">Nombre de la Categoría</label>
                <input type="text" name="name" required placeholder="Ej. Inteligencia Artificial" style="border-color: #1d4ed8;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="color: #93c5fd;">Descripción (Opcional)</label>
                <textarea name="description" rows="3" placeholder="Detalles sobre esta categoría..." 
                    style="width: 100%; background: #09090b; border: 1px solid #1d4ed8; color: #f4f4f5; padding: 12px; border-radius: 6px; font-family: inherit; margin-top: 6px;"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('categories.index') }}" class="btn-outline" style="text-align: center; flex: 1;">CANCELAR</a>
                <button type="submit" class="btn-code" style="flex: 1; background-color: #3b82f6; color: white;">GUARDAR</button>
            </div>
        </form>
    </div>

</body>
</html>
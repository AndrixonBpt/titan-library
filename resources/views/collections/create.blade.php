<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Colección - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;">

    <div class="container" style="max-width: 500px; border-color: #f59e0b; width: 100%; margin-top: 5vh;">
        <header style="border-bottom: 1px dashed #f59e0b; padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="font-size: 1.5rem; margin: 0;">
                <span style="color: #f59e0b;">✚</span> REGISTRAR COLECCIÓN
            </h1>
        </header>

        <form action="{{ route('collections.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="color: #fcd34d;">Nombre de la Saga / Colección</label>
                <input type="text" name="name" required placeholder="Ej. El Señor de los Anillos" style="border-color: #b45309;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="color: #fcd34d;">Descripción (Opcional)</label>
                <textarea name="description" rows="3" placeholder="Detalles de la serie..." 
                    style="width: 100%; background: #09090b; border: 1px solid #b45309; color: #f4f4f5; padding: 12px; border-radius: 6px; font-family: inherit; margin-top: 6px;"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('collections.index') }}" class="btn-outline" style="text-align: center; flex: 1;">CANCELAR</a>
                <button type="submit" class="btn-code" style="flex: 1; background-color: #f59e0b; color: #000; border-color: transparent;">GUARDAR</button>
            </div>
        </form>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Etiqueta - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;">

    <div class="container" style="max-width: 500px; border-color: #ec4899; width: 100%; margin-top: 5vh;">
        <header style="border-bottom: 1px dashed #ec4899; padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="font-size: 1.5rem; margin: 0;">
                <span style="color: #ec4899;">✚</span> REGISTRAR ETIQUETA
            </h1>
        </header>

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 30px;">
                <label style="color: #f9a8d4;">Nombre de la Etiqueta</label>
                <input type="text" name="name" required placeholder="Ej. Cyberseguridad" style="border-color: #be185d;">
                <small style="color: #8b949e; display: block; margin-top: 5px; font-family: monospace;">// No es necesario incluir el símbolo #</small>
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('tags.index') }}" class="btn-outline" style="text-align: center; flex: 1;">CANCELAR</a>
                <button type="submit" class="btn-code" style="flex: 1; background-color: #ec4899; color: #fff; border-color: transparent;">GUARDAR</button>
            </div>
        </form>
    </div>

</body>
</html>

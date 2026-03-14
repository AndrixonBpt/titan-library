<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Editorial - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;">

    <div class="container" style="max-width: 500px; border-color: #10b981; width: 100%; margin-top: 5vh;">
        <header style="border-bottom: 1px dashed #10b981; padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="font-size: 1.5rem; margin: 0;">
                <span style="color: #10b981;">✚</span> REGISTRAR EDITORIAL
            </h1>
        </header>

        <form action="{{ route('publishers.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="color: #6ee7b7;">Nombre de la Editorial</label>
                <input type="text" name="name" required placeholder="Ej. O'Reilly Media" style="border-color: #047857;">
            </div>
            
            <div style="margin-bottom: 24px;">
                <label style="color: #6ee7b7;">Sitio Web (Opcional)</label>
                <input type="url" name="website" placeholder="https://www.oreilly.com" style="border-color: #047857;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="color: #6ee7b7;">Descripción / País (Opcional)</label>
                <textarea name="description" rows="3" placeholder="Información de la empresa..." 
                    style="width: 100%; background: #09090b; border: 1px solid #047857; color: #f4f4f5; padding: 12px; border-radius: 6px; font-family: inherit; margin-top: 6px;"></textarea>
            </div>

            <div style="display: flex; gap: 15px;">
                <a href="{{ route('publishers.index') }}" class="btn-outline" style="text-align: center; flex: 1;">CANCELAR</a>
                <button type="submit" class="btn-code" style="flex: 1; background-color: #10b981; color: white; border-color: transparent;">GUARDAR</button>
            </div>
        </form>
    </div>

</body>
</html>
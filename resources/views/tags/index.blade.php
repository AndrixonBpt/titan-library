<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Etiquetas - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 800px; border-color: #ec4899;"> <!-- Borde Rosa -->
        <header style="border-bottom: 1px dashed #ec4899; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #ec4899;">[🏷️]</span> GESTIÓN DE ETIQUETAS
            </h1>
            <a href="{{ route('tags.create') }}" class="btn-code" style="background-color: #ec4899; color: #fff; padding: 8px 15px; font-size: 0.9rem;">
                + NUEVA ETIQUETA
            </a>
        </header>

        @if(session('success'))
            <div style="color: #ec4899; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #ec4899;">ID</th>
                        <th style="padding: 10px;">NOMBRE / PALABRA CLAVE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr style="border-bottom: 1px solid #21262d;">
                        <td style="padding: 10px; font-family: monospace;">{{ $tag->id }}</td>
                        <td style="padding: 10px; font-weight: bold; color: #fff;">#{{ $tag->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('library.index') }}" class="btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">../ VOLVER AL SISTEMA</a>
        </div>
    </div>

</body>
</html>

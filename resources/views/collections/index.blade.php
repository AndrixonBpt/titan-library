<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Colecciones - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 800px; border-color: #f59e0b;"> <!-- Borde Ámbar -->
        <header style="border-bottom: 1px dashed #f59e0b; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #f59e0b;">[📚]</span> GESTIÓN DE COLECCIONES
            </h1>
            <a href="{{ route('collections.create') }}" class="btn-code" style="background-color: #f59e0b; color: #000; padding: 8px 15px; font-size: 0.9rem;">
                + NUEVA COLECCIÓN
            </a>
        </header>

        @if(session('success'))
            <div style="color: #f59e0b; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #f59e0b;">ID</th>
                        <th style="padding: 10px;">NOMBRE DE SAGA / SERIE</th>
                        <th style="padding: 10px;">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $collection)
                    <tr style="border-bottom: 1px solid #21262d;">
                        <td style="padding: 10px; font-family: monospace;">{{ $collection->id }}</td>
                        <td style="padding: 10px; font-weight: bold; color: #fff;">{{ $collection->name }}</td>
                        <td style="padding: 10px; font-size: 0.85rem; color: #8b949e;">{{ $collection->description ?? '// N/A' }}</td>
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

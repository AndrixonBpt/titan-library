<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 800px; border-color: #3b82f6;">
        <header style="border-bottom: 1px dashed #3b82f6; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #3b82f6;">[📁]</span> GESTIÓN DE CATEGORÍAS
            </h1>
            <a href="{{ route('categories.create') }}" class="btn-code" style="padding: 8px 15px; font-size: 0.9rem;">
                + NUEVA CATEGORÍA
            </a>
        </header>

        @if(session('success'))
            <div style="color: #27c93f; margin-bottom: 15px;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #3b82f6;">ID</th>
                        <th style="padding: 10px;">NOMBRE</th>
                        <th style="padding: 10px;">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr style="border-bottom: 1px solid #21262d;">
                        <td style="padding: 10px;">{{ $category->id }}</td>
                        <td style="padding: 10px; font-weight: bold; color: #fff;">{{ $category->name }}</td>
                        <td style="padding: 10px; font-size: 0.85rem; color: #8b949e;">{{ $category->description ?? '// Sin descripción' }}</td>
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

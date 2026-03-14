<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Estanterías - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">
    <div class="container" style="max-width: 900px; border-color: #8b5cf6;">
        <header style="border-bottom: 1px dashed #8b5cf6; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #8b5cf6;">[📚]</span> MY_SHELVES (PLAYLISTS)
            </h1>
            <span style="font-size: 0.8rem; color: #8b949e; font-family: monospace;">USER: {{ Auth::user()->name }}</span>
        </header>

        @if(session('success'))
            <div style="color: #27c93f; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <!-- Crear nueva estantería -->
        <div style="background: #0d1117; padding: 20px; border: 1px solid #30363d; border-radius: 6px; margin-bottom: 30px;">
            <form action="{{ route('shelves.store') }}" method="POST" style="display: flex; gap: 15px; align-items: flex-end; margin: 0; flex-wrap: wrap;">
                @csrf
                <div style="flex: 1; min-width: 250px;">
                    <label style="color: #8b5cf6; font-size: 0.8rem; display: block; margin-bottom: 5px; font-family: monospace;">> NOMBRE DE LA ESTANTERÍA</label>
                    <input type="text" name="name" required placeholder="Ej. Para leer este fin de semana..." style="width: 100%; box-sizing: border-box; background: #161b22; border: 1px solid #30363d; color: #c9d1d9; padding: 8px; border-radius: 4px; font-family: monospace;">
                </div>
                <button type="submit" style="background: #8b5cf6; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-family: monospace; font-weight: bold;">
                    + CREAR
                </button>
            </form>
        </div>

        <!-- Lista de estanterías en Tarjetas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            @forelse($shelves as $shelf)
                <a href="{{ route('shelves.show', $shelf->id) }}" style="display: block; background: #0d1117; border: 1px solid #30363d; border-radius: 6px; padding: 20px; text-decoration: none; transition: 0.2s;" onmouseover="this.style.borderColor='#8b5cf6';" onmouseout="this.style.borderColor='#30363d';">
                    <h3 style="color: #e6edf3; margin-top: 0; margin-bottom: 10px; font-size: 1.1rem;">{{ $shelf->name }}</h3>
                    <div style="color: #8b949e; font-size: 0.8rem; font-family: monospace;">> LIBROS GUARDADOS: {{ $shelf->books_count }}</div>
                </a>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: #8b949e; padding: 20px; border: 1px dashed #30363d; font-family: monospace;">// NO TIENES ESTANTERÍAS CREADAS</div>
            @endforelse
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('library.index') }}" class="btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">../ VOLVER AL SISTEMA</a>
        </div>
    </div>
</body>
</html>
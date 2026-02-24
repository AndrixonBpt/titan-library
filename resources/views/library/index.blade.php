
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TITAN Library</title>
    <!-- Enlace al nuevo diseño -->
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body>

    <div class="container">
        <header>
            <h1><span>◼</span> TITAN LIBRARY_</h1>
            
            <div style="display: flex; gap: 10px; align-items: center;">
                <!-- Nombre del Usuario -->
                <span style="font-size: 0.8rem; color: var(--text-secondary); margin-right: 10px;">
                    USER: {{ Auth::user()->name }} [{{ strtoupper(Auth::user()->role) }}]
                </span>
        
                <!-- Botón Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary" style="background: #333; padding: 8px 15px; font-size: 0.8rem;">
                        SALIR
                    </button>
                </form>
        
                <!-- Botón Agregar (SOLO BIBLIOTECARIOS) -->
                @if(Auth::user()->role === 'bibliotecario')
                    <a href="{{ route('library.create') }}" class="btn-primary">
                        + AGREGAR
                    </a>
                @endif
            </div>
        </header>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Título de la obra</th>
                        <th>Autor</th>
                        <th>Año</th>
                        <th>ISBN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td><span class="badge">{{ $book->author->name }}</span></td>
                        <td style="color: var(--text-secondary);">{{ $book->published_year }}</td>
                        <td style="font-family: monospace;">{{ $book->isbn }}</td>
                        <td><a href="{{ route('library.show', $book->id) }}" style="color: var(--accent); text-decoration: none; font-weight: bold; border: 1px solid var(--accent); padding: 5px 10px; border-radius: 4px; font-size: 0.8rem;">
> VIEW_FILE
        </a>
    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($books->isEmpty())
            <div style="text-align: center; margin-top: 40px; color: var(--text-secondary);">
                <p>// SISTEMA VACÍO. INGRESE DATOS.</p>
            </div>
        @endif
    </div>

</body>
</html>
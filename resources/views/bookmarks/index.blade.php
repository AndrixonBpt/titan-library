<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Favoritos - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 900px; border-color: #ff5f56;">
        <header style="border-bottom: 1px dashed #ff5f56; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #ff5f56;">[♥]</span> MY_BOOKMARKS
            </h1>
            <span style="font-size: 0.8rem; color: #8b949e; font-family: monospace;">
                USER: {{ Auth::user()->name }}
            </span>
        </header>

        @if(session('success'))
            <div style="color: #ff5f56; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #ff5f56; font-size: 0.8rem;">TÍTULO</th>
                        <th style="padding: 10px; color: var(--text-secondary); font-size: 0.8rem;">AUTOR</th>
                        <th style="padding: 10px; color: var(--text-secondary); font-size: 0.8rem;">AÑADIDO EL</th>
                        <th style="padding: 10px; color: var(--text-secondary); font-size: 0.8rem;">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookmarks as $bookmark)
                    <tr style="border-bottom: 1px solid #21262d; transition: background 0.2s;">
                        <td style="padding: 15px 10px; font-weight: bold; color: #fff;">
                            {{ $bookmark->book->title }}
                        </td>
                        <td style="padding: 15px 10px;">
                            <span style="background: #21262d; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; border: 1px solid #30363d;">
                                {{ $bookmark->book->author->name }}
                            </span>
                        </td>
                        <td style="padding: 15px 10px; font-size: 0.85rem; color: #8b949e; font-family: monospace;">
                            {{ $bookmark->created_at->format('d/m/Y') }}
                        </td>
                        <td style="padding: 15px 10px; display: flex; gap: 10px;">
                            <!-- Ver archivo -->
                            <a href="{{ route('library.show', $bookmark->book_id) }}" style="color: var(--accent); text-decoration: none; border: 1px solid var(--accent); padding: 4px 8px; font-size: 0.8rem; font-family: monospace; border-radius: 4px;">
                                > OPEN
                            </a>
                            
                            <!-- Botón para quitar de favoritos -->
                            <form action="{{ route('bookmarks.toggle', $bookmark->book_id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: transparent; border: 1px solid #ff5f56; color: #ff5f56; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 0.8rem; font-family: monospace;" title="Quitar de Favoritos">
                                    [X] REMOVE
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($bookmarks->isEmpty())
            <div style="text-align: center; margin-top: 40px; color: #8b949e; font-family: monospace;">
                <p>// NO SAVED DATA FOUND.</p>
            </div>
        @endif

        <div style="margin-top: 30px;">
            <a href="{{ route('library.index') }}" class="btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">../ VOLVER AL CATÁLOGO</a>
        </div>
    </div>

</body>
</html>
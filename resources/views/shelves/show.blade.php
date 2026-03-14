<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $shelf->name }} - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">
    <div class="container" style="max-width: 900px; border-color: #8b5cf6;">
        <header style="border-bottom: 1px dashed #8b5cf6; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #8b5cf6;">[📚]</span> {{ strtoupper($shelf->name) }}
            </h1>
            <a href="{{ route('shelves.index') }}" class="btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">../ VOLVER</a>
        </header>

        @if(session('success'))
            <div style="color: #27c93f; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #8b5cf6; font-size: 0.8rem;">TÍTULO</th>
                        <th style="padding: 10px; color: var(--text-secondary); font-size: 0.8rem;">AUTOR</th>
                        <th style="padding: 10px; color: var(--text-secondary); font-size: 0.8rem;">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shelf->books as $book)
                    <tr style="border-bottom: 1px solid #21262d;">
                        <td style="padding: 10px; font-weight: bold; color: #fff;">{{ $book->title }}</td>
                        <td style="padding: 10px; font-size: 0.85rem;">{{ $book->author->name }}</td>
                        <td style="padding: 10px; display: flex; gap: 10px;">
                            <a href="{{ route('library.show', $book->id) }}" style="color: var(--accent); text-decoration: none; border: 1px solid var(--accent); padding: 4px 8px; font-size: 0.75rem; border-radius: 4px; font-family: monospace;">> OPEN_FILE</a>
                            
                            <form action="{{ route('shelves.removeBook', ['shelf_id' => $shelf->id, 'book_id' => $book->id]) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: transparent; border: 1px solid #ff5f56; color: #ff5f56; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 0.75rem; font-family: monospace;">[X] REMOVE</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 20px; text-align: center; color: #8b949e; font-family: monospace;">// LA ESTANTERÍA ESTÁ VACÍA</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
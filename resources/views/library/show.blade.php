<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FILE: {{ $book->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body>

    <div class="container" style="max-width: 700px; border-color: var(--accent);">
        
        <header style="border-bottom: 1px dashed var(--accent); padding-bottom: 20px; margin-bottom: 30px;">
            <div style="font-size: 0.8rem; color: #8b949e; margin-bottom: 10px;">
                > ACCESSING DATABANK... <span style="color: #27c93f;">SUCCESS</span>
            </div>
            <h1 style="font-size: 1.8rem; color: #e6edf3;">
                <span style="color: var(--accent);">FILE_ID_{{ $book->id }}:</span> 
                {{ strtoupper($book->title) }}
            </h1>
        </header>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 40px;">
            <div style="background: #0d1117; padding: 20px; border: 1px solid #30363d; border-radius: 6px;">
                <h3 style="color: #8b949e; font-size: 0.8rem; margin-top: 0;">> METADATA</h3>
                <div style="margin-bottom: 15px;">
                    <span style="color: #58a6ff;">AUTHOR:</span><br>
                    <span style="font-size: 1.1rem;">{{ $book->author->name }}</span>
                </div>
                <div>
                    <span style="color: #58a6ff;">ISBN_HASH:</span><br>
                    <span style="font-family: monospace; background: #21262d; padding: 2px 6px;">{{ $book->isbn }}</span>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; border: 1px dashed #30363d; padding: 20px; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 10px;">📄</div>
                <!-- Comprobamos si hay archivo -->
                @if($book->file_path)
                    <div style="color: #27c93f; font-weight: bold; margin-bottom: 5px;">PDF AVAILABLE</div>
                    <div style="font-size: 0.8rem; color: #8b949e;">SECURE STORAGE</div>
                @else
                    <div style="color: #ff5f56; font-weight: bold;">NO DATA</div>
                @endif
            </div>
        </div>

        <div style="display: flex; gap: 15px; border-top: 1px solid #30363d; padding-top: 20px;">
            
            <!-- Botón de Descarga REAL -->
            @if($book->file_path)
                <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="btn-code" style="text-align: center; flex: 1;">
                    [ ↓ DOWNLOAD_PDF ]
                </a>
            @else
                <button disabled class="btn-outline" style="opacity: 0.5; flex: 1;">FILE_NOT_FOUND</button>
            @endif

            <a href="{{ route('library.index') }}" class="btn-outline" style="text-align: center;">
                ../ RETURN
            </a>
        </div>

    </div>

</body>
</html>

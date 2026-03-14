<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Centro de Mando - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
    <style>
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: #0d1117;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
            font-family: monospace;
        }
    </style>
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 1000px; border-color: #58a6ff;">
        
        <header style="border-bottom: 1px dashed #58a6ff; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.8rem; color: #e6edf3; margin: 0;">
                <span style="color: #58a6ff;">[📊]</span> COMMAND_CENTER
            </h1>
            <a href="{{ route('library.index') }}" class="btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">../ VOLVER AL SISTEMA</a>
        </header>

        <div class="stat-grid">
            <div class="stat-card" style="border-top: 3px solid #3b82f6;">
                <span style="color: #8b949e; font-size: 0.85rem; font-family: monospace;">> TOTAL_FILES</span>
                <span class="stat-number" style="color: #3b82f6;">{{ $totalBooks }}</span>
            </div>

            <div class="stat-card" style="border-top: 3px solid #a855f7;">
                <span style="color: #8b949e; font-size: 0.85rem; font-family: monospace;">> REGISTERED_USERS</span>
                <span class="stat-number" style="color: #a855f7;">{{ $totalUsers }}</span>
            </div>

            <div class="stat-card" style="border-top: 3px solid #27c93f;">
                <span style="color: #8b949e; font-size: 0.85rem; font-family: monospace;">> SUCCESSFUL_DOWNLOADS</span>
                <span class="stat-number" style="color: #27c93f;">{{ $totalDownloads }}</span>
            </div>
        </div>

        <div class="stat-grid" style="grid-template-columns: 1fr 1fr;">
            <a href="{{ route('requests.index') }}" class="stat-card" style="border: 1px dashed {{ $pendingRequests > 0 ? '#ffbd2e' : '#30363d' }}; text-decoration: none; transition: 0.2s;">
                <span style="color: #8b949e; font-size: 0.85rem; font-family: monospace;">> PENDING_REQUESTS (TICKETS)</span>
                <span class="stat-number" style="color: {{ $pendingRequests > 0 ? '#ffbd2e' : '#8b949e' }};">{{ $pendingRequests }}</span>
                @if($pendingRequests > 0) <span style="color: #ffbd2e; font-size: 0.75rem;">// ACCIÓN REQUERIDA</span> @endif
            </a>

            <a href="{{ route('reports.index') }}" class="stat-card" style="border: 1px dashed {{ $pendingReports > 0 ? '#ff5f56' : '#30363d' }}; text-decoration: none; transition: 0.2s;">
                <span style="color: #8b949e; font-size: 0.85rem; font-family: monospace;">> SYSTEM_ALERTS (REPORTS)</span>
                <span class="stat-number" style="color: {{ $pendingReports > 0 ? '#ff5f56' : '#8b949e' }};">{{ $pendingReports }}</span>
                @if($pendingReports > 0) <span style="color: #ff5f56; font-size: 0.75rem;">// FALLAS DETECTADAS</span> @endif
            </a>
        </div>

        <div style="background: #0d1117; border: 1px solid #30363d; border-radius: 6px; padding: 20px;">
            <h3 style="color: #e6edf3; font-size: 1.1rem; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid #30363d; padding-bottom: 10px;">
                <span style="color: #e3b341;">★</span> TOP_DOWNLOADED_FILES
            </h3>
            
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #21262d;">
                        <th style="padding: 10px; color: #8b949e; font-size: 0.8rem;">RANK</th>
                        <th style="padding: 10px; color: #8b949e; font-size: 0.8rem;">TÍTULO</th>
                        <th style="padding: 10px; color: #8b949e; font-size: 0.8rem;">AUTOR</th>
                        <th style="padding: 10px; color: #27c93f; font-size: 0.8rem; text-align: right;">DESCARGAS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topBooks as $index => $book)
                    <tr style="border-bottom: 1px solid #21262d;">
                        <td style="padding: 10px; font-family: monospace; color: #e3b341; font-weight: bold;">#{{ $index + 1 }}</td>
                        <td style="padding: 10px; font-weight: bold; color: #fff;">
                            <a href="{{ route('library.show', $book->id) }}" style="color: #fff; text-decoration: none;">{{ $book->title }}</a>
                        </td>
                        <td style="padding: 10px; font-size: 0.85rem;">{{ $book->author->name }}</td>
                        <td style="padding: 10px; font-family: monospace; color: #27c93f; font-weight: bold; text-align: right;">{{ $book->downloads_count }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 20px; text-align: center; color: #8b949e;">// SIN REGISTROS DE DESCARGA</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
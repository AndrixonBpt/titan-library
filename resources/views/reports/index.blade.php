<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Reportes - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 1000px; border-color: #ff5f56;">
        <header style="border-bottom: 1px dashed #ff5f56; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #ff5f56;">[🚨]</span> SYSTEM_ALERTS (REPORTES)
            </h1>
        </header>

        @if(session('success'))
            <div style="color: #27c93f; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #ff5f56;">ID</th>
                        <th style="padding: 10px;">REPORTERO</th>
                        <th style="padding: 10px;">ARCHIVO AFECTADO</th>
                        <th style="padding: 10px;">PROBLEMA DETECTADO</th>
                        <th style="padding: 10px;">ESTADO</th>
                        <th style="padding: 10px;">ADMIN_ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr style="border-bottom: 1px solid #21262d; background: {{ $report->status == 'pending' ? 'rgba(255, 95, 86, 0.05)' : 'transparent' }};">
                        <td style="padding: 10px; font-family: monospace;">#{{ $report->id }}</td>
                        <td style="padding: 10px;">{{ $report->user->name }}</td>
                        <td style="padding: 10px;">
                            <a href="{{ route('library.show', $report->book_id) }}" style="color: var(--accent); text-decoration: none; font-weight: bold;">
                                {{ $report->book->title }}
                            </a>
                        </td>
                        <td style="padding: 10px;">
                            <span style="color: #ff5f56; font-weight: bold;">{{ $report->issue_type }}</span><br>
                            <span style="font-size: 0.8rem; color: #8b949e;">{{ $report->description ?? '// Sin detalles extra' }}</span>
                        </td>
                        <td style="padding: 10px; font-weight: bold;">
                            @if($report->status == 'pending') <span style="color: #ffbd2e;">⏳ PENDING</span>
                            @elseif($report->status == 'resolved') <span style="color: #27c93f;">✅ RESOLVED</span>
                            @else <span style="color: #8b949e;">❌ DISMISSED</span>
                            @endif
                        </td>
                        <td style="padding: 10px;">
                            <form action="{{ route('reports.update', $report->id) }}" method="POST" style="display: flex; gap: 5px; margin: 0;">
                                @csrf
                                @method('PUT')
                                <select name="status" style="background: #0d1117; border: 1px solid #30363d; color: #c9d1d9; border-radius: 4px; padding: 4px;">
                                    <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="dismissed" {{ $report->status == 'dismissed' ? 'selected' : '' }}>Dismissed</option>
                                </select>
                                <button type="submit" style="background: #30363d; color: #fff; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-family: monospace;">[>] UPDATE</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 20px; text-align: center; color: #8b949e;">// NO SE DETECTAN ALERTAS EN EL SISTEMA</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('library.index') }}" class="btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">../ VOLVER AL SISTEMA</a>
        </div>
    </div>

</body>
</html>

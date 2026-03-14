<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Peticiones - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 1000px; border-color: #a855f7;">
        <header style="border-bottom: 1px dashed #a855f7; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.5rem; color: #e6edf3; margin: 0;">
                <span style="color: #a855f7;">[📦]</span> TICKET_CENTER (PETICIONES)
            </h1>
        </header>

        @if(session('success'))
            <div style="color: #27c93f; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #a855f7;">ID</th>
                        <th style="padding: 10px;">USUARIO</th>
                        <th style="padding: 10px;">LIBRO SOLICITADO</th>
                        <th style="padding: 10px;">ESTADO</th>
                        <th style="padding: 10px;">ACCIÓN ADMIN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                    <tr style="border-bottom: 1px solid #21262d; background: {{ $req->status == 'pending' ? 'rgba(168, 85, 247, 0.05)' : 'transparent' }};">
                        <td style="padding: 10px; font-family: monospace;">#{{ $req->id }}</td>
                        <td style="padding: 10px;">{{ $req->user->name }}</td>
                        <td style="padding: 10px;">
                            <strong style="color: #fff;">{{ $req->title }}</strong><br>
                            <span style="font-size: 0.8rem; color: #8b949e;">{{ $req->author_name ?? 'Autor desconocido' }}</span>
                        </td>
                        <td style="padding: 10px; font-weight: bold;">
                            @if($req->status == 'pending') <span style="color: #ffbd2e;">⏳ PENDING</span>
                            @elseif($req->status == 'completed') <span style="color: #27c93f;">✅ COMPLETED</span>
                            @else <span style="color: #ff5f56;">❌ REJECTED</span>
                            @endif
                        </td>
                        <td style="padding: 10px;">
                            <form action="{{ route('requests.update', $req->id) }}" method="POST" style="display: flex; gap: 5px; margin: 0;">
                                @csrf
                                @method('PUT')
                                <select name="status" style="background: #0d1117; border: 1px solid #30363d; color: #c9d1d9; border-radius: 4px; padding: 4px;">
                                    <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit" style="background: #30363d; color: #fff; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-family: monospace;">[>] UPDATE</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #8b949e;">// NO HAY PETICIONES ACTIVAS</td>
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
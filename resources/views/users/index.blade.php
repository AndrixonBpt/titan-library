<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body" style="padding: 40px;">

    <div class="container" style="max-width: 1000px; border-color: #06b6d4;">
        
        <header style="border-bottom: 1px dashed #06b6d4; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 1.8rem; color: #e6edf3; margin: 0;">
                <span style="color: #06b6d4;">[👥]</span> USER_DATABASE
            </h1>
            <a href="{{ route('library.index') }}" class="btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">../ VOLVER AL SISTEMA</a>
        </header>

        @if(session('success'))
            <div style="color: #27c93f; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="color: #ff5f56; margin-bottom: 15px; font-family: monospace;">> {{ session('error') }}</div>
        @endif

        <div class="table-container">
            <table style="width: 100%; text-align: left; color: #c9d1d9; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #30363d;">
                        <th style="padding: 10px; color: #06b6d4;">ID</th>
                        <th style="padding: 10px;">ALIAS / NOMBRE</th>
                        <th style="padding: 10px;">CORREO ENCRIPTADO</th>
                        <th style="padding: 10px;">NIVEL DE ACCESO</th>
                        <th style="padding: 10px;">REGISTRO</th>
                        <th style="padding: 10px;">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid #21262d;">
                        <td style="padding: 10px; font-family: monospace; color: #8b949e;">#{{ $user->id }}</td>
                        <td style="padding: 10px; font-weight: bold; color: #fff;">{{ $user->name }}</td>
                        <td style="padding: 10px; font-family: monospace; color: #8b949e;">{{ $user->email }}</td>
                        
                        <td style="padding: 10px;">
                            @if($user->role === 'bibliotecario')
                                <span style="background: rgba(6, 182, 212, 0.1); color: #06b6d4; border: 1px solid #06b6d4; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-family: monospace;">ADMIN</span>
                            @else
                                <span style="background: rgba(139, 148, 158, 0.1); color: #8b949e; border: 1px solid #30363d; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-family: monospace;">LECTOR</span>
                            @endif
                        </td>
                        
                        <td style="padding: 10px; font-family: monospace; font-size: 0.8rem; color: #8b949e;">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        
                        <td style="padding: 10px; display: flex; gap: 10px;">
                            <!-- Formulario para cambiar Rol -->
                            <form action="{{ route('users.updateRole', $user->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{ $user->role === 'lector' ? 'bibliotecario' : 'lector' }}">
                                <button type="submit" 
                                    style="background: transparent; border: 1px dashed #06b6d4; color: #06b6d4; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-family: monospace; font-size: 0.75rem;"
                                    title="{{ $user->role === 'lector' ? 'Promover a Admin' : 'Revocar a Lector' }}"
                                    {{ Auth::id() == $user->id ? 'disabled' : '' }}> <!-- Deshabilitar si es el mismo usuario -->
                                    [⬆] TOGGLE_ROLE
                                </button>
                            </form>

                            <!-- Formulario para Eliminar -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Confirmar purga de usuario? Esta acción es irreversible.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    style="background: transparent; border: 1px dashed #ff5f56; color: #ff5f56; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-family: monospace; font-size: 0.75rem;"
                                    title="Eliminar Usuario"
                                    {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                    [X] PURGE
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>

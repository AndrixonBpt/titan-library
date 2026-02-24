<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TITAN LOGIN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #09090b;">

    <div class="container" style="max-width: 400px; text-align: center; animation: slideIn 0.5s ease-out;">
        <h1 style="justify-content: center; margin-bottom: 30px;">
            ACCESS <span style="color: var(--accent);">CONTROL</span>
        </h1>

        <!-- Mensaje de Error si falla la contraseña -->
        @if($errors->any())
            <div style="color: #ff5f56; background: rgba(255, 95, 86, 0.1); padding: 10px; margin-bottom: 20px; border-radius: 4px; font-size: 0.9rem;">
                ⚠️ ACCESO DENEGADO
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            
            <div style="text-align: left; margin-bottom: 20px;">
                <label>ID DE USUARIO (EMAIL)</label>
                <input type="email" name="email" required placeholder="admin@titan.com">
            </div>

            <div style="text-align: left; margin-bottom: 30px;">
                <label>CLAVE DE ACCESO</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">
                INICIAR SESIÓN >
            </button>
        </form>

        <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #333;">
            <a href="{{ route('register') }}" style="color: var(--text-secondary); font-size: 0.9rem; text-decoration: none;">
                ¿No tienes acceso? <span style="color: var(--accent);">Crea una cuenta</span>
            </a>
        </div>
        
        <div style="margin-top: 20px; font-size: 0.8rem; color: #666;">
            SECURE CONNECTION ENCRYPTED
        </div>
    </div>

</body>
</html>
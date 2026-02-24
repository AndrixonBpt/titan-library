<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TITAN SIGN UP</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #09090b; padding: 20px;">

    <div class="container" style="max-width: 450px; text-align: center; animation: slideIn 0.5s ease-out; border-color: var(--accent);">
        <h1 style="justify-content: center; margin-bottom: 30px;">
            NEW <span style="color: var(--accent);">ACCOUNT</span>
        </h1>

        <!-- Errores de Validación -->
        @if($errors->any())
            <div style="text-align: left; color: #ff5f56; background: rgba(255, 95, 86, 0.1); padding: 15px; margin-bottom: 20px; border-radius: 4px; font-size: 0.8rem; border: 1px solid #ff5f56;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf
            
            <div style="text-align: left; margin-bottom: 20px;">
                <label>NOMBRE CLAVE (Alias)</label>
                <input type="text" name="name" required placeholder="Ej. Neo" value="{{ old('name') }}">
            </div>

            <div style="text-align: left; margin-bottom: 20px;">
                <label>CORREO ELECTRÓNICO</label>
                <input type="email" name="email" required placeholder="user@titan.com" value="{{ old('email') }}">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                <div style="text-align: left;">
                    <label>CONTRASEÑA</label>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>
                <div style="text-align: left;">
                    <label>CONFIRMAR</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">
                REGISTRARSE >
            </button>
        </form>
        
        <!-- CORRECCIÓN AQUÍ: Usamos padding-top en lugar de pt-4 -->
        <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #333;">
            <a href="{{ route('login') }}" style="color: var(--text-secondary); font-size: 0.9rem; text-decoration: none;">
                ¿Ya tienes cuenta? <span style="color: var(--accent);">Inicia Sesión</span>
            </a>
        </div>
    </div>

</body>
</html>

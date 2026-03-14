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
                <!-- Agregamos box-sizing para que tenga exactamente el mismo ancho que el campo de clave -->
                <input type="email" name="email" required placeholder="admin@titan.com" style="width: 100%; box-sizing: border-box;">
            </div>

            <div style="text-align: left; margin-bottom: 30px;">
                <label>CLAVE DE ACCESO</label>
                <div style="position: relative;">
                    <!-- Se añadió ID y padding-right para que el texto no pise el icono -->
                    <input type="password" name="password" id="password" required placeholder="••••••••" style="width: 100%; padding-right: 40px; box-sizing: border-box;">
                    
                    <!-- Botón del Ojo superpuesto -->
                    <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #8b949e; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; transition: color 0.2s;">
                        
                        <!-- Icono: Ojo Abierto -->
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        
                        <!-- Icono: Ojo Cerrado (Oculto por defecto) -->
                        <svg id="eyeOffIcon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                    
                    </button>
                </div>
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

    <!-- Script para dar vida al botón del ojito -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function () {
            // Cambiar el tipo de input (de password a text)
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Alternar los iconos SVG
            if (type === 'text') {
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
                this.style.color = 'var(--accent)'; // Se enciende color ámbar
            } else {
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
                this.style.color = '#8b949e'; // Vuelve a color gris
            }
        });
    </script>
</body>
</html>
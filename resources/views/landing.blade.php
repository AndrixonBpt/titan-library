<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TITAN Dev_Lib</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body class="landing-body">

    <div class="hero-section">
        
        <!-- COLUMNA IZQUIERDA: Info -->
        <div class="hero-text">
            <div class="repo-badge">
                <span class="pulse">●</span> branch: main / v.3.0
            </div>
            
            <h1 class="mega-title">
                TITAN <span class="highlight">DEV_LIB</span>
            </h1>
            
            <p class="subtitle">
                // Repositorio central de conocimiento.<br>
                // Optimizado para desarrolladores Full Stack.
            </p>

            <div class="btn-group">
                <!--  comando de consola -->
                <a href="{{ route('library.index') }}" class="btn-code">
                    <span style="color: #a5b3ce">$</span> cd /iniciar_sistema
                </a>
                <a href="#" class="btn-outline">
                    man readme.md
                </a>
            </div>

            <!-- Datos técnicos  -->
            <div class="server-stats">
                <span>> UPTIME: 99.9%</span>
                <span>> LATENCY: 12ms</span>
                <span>> DB: MYSQL</span>
            </div>
        </div>

        <!-- COLUMNA DERECHA: La Terminal -->
        <div class="terminal-window">
            <div class="terminal-header">
                <div class="dot red"></div>
                <div class="dot yellow"></div>
                <div class="dot green"></div>
                <div class="terminal-title">bash — titan-server</div>
            </div>
            <div class="terminal-body">
                <div class="code-line">
                    <span class="purple">import</span> Knowledge <span class="purple">from</span> <span class="green">'titan-lib'</span>;
                </div>
                <div class="code-line">
                    <span class="purple">const</span> library = <span class="purple">new</span> Library();
                </div>
                <br>
                <div class="code-line">
                    <span class="blue">library.connect</span>({
                </div>
                <div class="code-line indent">
                    mode: <span class="green">'secure'</span>,
                </div>
                <div class="code-line indent">
                    user: <span class="green">'admin'</span>
                </div>
                <div class="code-line">});</div>
                <br>
                <div class="code-line comment">// Estableciendo conexión segura...</div>
                <div class="code-line">> Conectado a localhost:8000</div>
                <div class="code-line">> Cargando módulos de libros... <span class="yellow">Done</span></div>
                <div class="code-line">> Acceso concedido <span class="cursor">_</span></div>
            </div>
        </div>

    </div>

</body>
</html>

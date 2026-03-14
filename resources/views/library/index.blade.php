<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TITAN Library</title>
    <!-- Enlace al nuevo diseño -->
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
    
    <style>
        /* Estilos para el Menú Desplegable TITAN */
        .titan-dropdown {
            position: relative;
            display: inline-block;
            padding-bottom: 10px; /* <--- AGREGADO: Crea un puente invisible */
        }
        .titan-dropdown-content {
            display: none;
            position: absolute;
            right: 0; /* Se abre hacia la izquierda para no salirse de la pantalla */
            background-color: #0d1117;
            min-width: 220px;
            box-shadow: 0px 15px 25px rgba(0,0,0,0.9);
            z-index: 50;
            border: 1px solid #30363d;
            border-radius: 6px;
            top: 100%; /* <--- AGREGADO: Lo pega al fondo del contenedor padre */
            margin-top: 0px; /* <--- MODIFICADO: Eliminamos el hueco que cerraba el menú */
            overflow: hidden;
        }
        .titan-dropdown:hover .titan-dropdown-content {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }
        .titan-dropdown-content a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 0.85rem;
            border-bottom: 1px solid #21262d;
            font-family: monospace;
            transition: all 0.2s;
        }
        .titan-dropdown-content a:hover {
            background-color: #161b22;
            padding-left: 20px; /* Pequeño salto a la derecha al pasar el mouse */
        }
        .titan-dropdown-content a:last-child {
            border-bottom: none;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- HEADER REDISEÑADO Y ALINEADO -->
        <header style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #30363d; padding-bottom: 20px; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
            
            <!-- Izquierda: Título -->
            <h1 style="margin: 0; font-size: 1.8rem; flex-shrink: 0;"><span>◼</span> TITAN LIBRARY_</h1>
            
            <!-- Derecha: Controles (Alineados a la derecha con margin-left: auto) -->
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-left: auto; justify-content: flex-end;">
                
                <!-- Nombre del Usuario -->
                <span style="font-size: 0.8rem; color: #8b949e; margin-right: 10px; font-family: monospace;">
                    USER: {{ Auth::user()->name }} [{{ strtoupper(Auth::user()->role) }}]
                </span>
        
                <!-- Botón Mis Favoritos (PARA TODOS) -->
                <a href="{{ route('bookmarks.index') }}" style="color: #ff5f56; text-decoration: none; font-size: 0.8rem; font-family: monospace; border: 1px solid #ff5f56; padding: 6px 12px; border-radius: 4px; transition: 0.2s;">
                    [♥] FAVORITOS
                </a>

                <!-- NUEVO BOTÓN: MIS ESTANTERÍAS (PARA TODOS) -->
                <a href="{{ route('shelves.index') }}" style="color: #8b5cf6; text-decoration: none; font-size: 0.8rem; font-family: monospace; border: 1px solid #8b5cf6; padding: 6px 12px; border-radius: 4px; transition: 0.2s;">
                    [📚] MY_SHELVES
                </a>
                
                <!-- NUEVO BOTÓN: PEDIR LIBRO (PARA TODOS) -->
                <a href="{{ route('requests.create') }}" style="color: #a855f7; text-decoration: none; font-size: 0.8rem; font-family: monospace; border: 1px dashed #a855f7; padding: 6px 12px; border-radius: 4px; transition: 0.2s;">
                    [+] REQUEST_BOOK
                </a>
        
                <!-- Controles SOLO BIBLIOTECARIOS -->
                @if(Auth::user()->role === 'bibliotecario')
                    
                    <!-- Menú Desplegable (Dropdown) -->
                    <div class="titan-dropdown">
                        <button style="background: transparent; border: 1px dashed #8b949e; color: #8b949e; padding: 6px 15px; font-size: 0.8rem; cursor: pointer; border-radius: 4px; font-family: monospace;">
                            ⚙️ ADMIN_TOOLS ▼
                        </button>
                        <div class="titan-dropdown-content">
                            <a href="{{ route('dashboard.index') }}" style="color: #58a6ff; font-weight: bold; border-bottom: 1px dashed #30363d; padding-bottom: 12px; margin-bottom: 5px;">[📊] COMMAND_CENTER</a>
                            <a href="{{ route('categories.index') }}" style="color: #3b82f6;">[📁] CATEGORÍAS</a>
                            <a href="{{ route('publishers.index') }}" style="color: #10b981;">[🏢] EDITORIALES</a>
                            <a href="{{ route('users.index') }}" style="color: #06b6d4;">[👥] USUARIOS</a>
                            <a href="{{ route('collections.index') }}" style="color: #f59e0b;">[📚] COLECCIONES</a>
                            <a href="{{ route('tags.index') }}" style="color: #ec4899;">[🏷️] ETIQUETAS</a>
                            
                            <!-- Borra el duplicado y deja solo ESTOS DOS enlaces al final -->
                            <a href="{{ route('requests.index') }}" style="color: #a855f7; border-top: 1px dashed #30363d; margin-top: 5px;">[📦] VER PETICIONES</a>
                            <a href="{{ route('reports.index') }}" style="color: #ff5f56; border-top: 1px dashed #30363d;">[🚨] VER REPORTES</a>
                        </div>
                    </div>

                    <!-- Botón Agregar Libro -->
                    <a href="{{ route('library.create') }}" class="btn-primary" style="padding: 6px 15px; font-size: 0.8rem; font-family: monospace;">
                        + AGREGAR
                    </a>
                @endif

                <!-- Botón Logout Minimalista -->
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: transparent; border: none; color: #8b949e; font-size: 0.8rem; font-family: monospace; cursor: pointer; text-decoration: underline; padding: 0 5px;">
                        [SALIR]
                    </button>
                </form>

            </div>
        </header>

        <!-- ========================================== -->
        <!-- BARRA DE FILTROS DE BÚSQUEDA (Restaurada) -->
        <!-- ========================================== -->
        <div style="background: #0d1117; border: 1px dashed #30363d; border-radius: 6px; padding: 15px; margin-bottom: 20px; animation: fadeIn 0.3s ease-out;">
            <form action="{{ route('library.index') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; margin: 0;">
                
                <!-- Buscar por Título -->
                <div style="flex: 1; min-width: 200px;">
                    <label style="color: #8b949e; font-size: 0.75rem; font-family: monospace; display: block; margin-bottom: 5px;">> SEARCH_TITLE</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ej. Clean Code..." style="width: 100%; box-sizing: border-box; background: #161b22; border: 1px solid #30363d; color: #c9d1d9; padding: 8px 12px; border-radius: 4px; font-family: monospace;">
                </div>

                <!-- Filtrar por Categoría -->
                <div style="flex: 1; min-width: 150px;">
                    <label style="color: #3b82f6; font-size: 0.75rem; font-family: monospace; display: block; margin-bottom: 5px;">> CATEGORY</label>
                    <select name="category_id" style="width: 100%; box-sizing: border-box; background: #161b22; border: 1px solid #30363d; color: #c9d1d9; padding: 8px; border-radius: 4px; font-family: monospace;">
                        <option value="">-- Todas --</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtrar por Autor -->
                <div style="flex: 1; min-width: 150px;">
                    <label style="color: #a855f7; font-size: 0.75rem; font-family: monospace; display: block; margin-bottom: 5px;">> AUTHOR</label>
                    <select name="author_id" style="width: 100%; box-sizing: border-box; background: #161b22; border: 1px solid #30363d; color: #c9d1d9; padding: 8px; border-radius: 4px; font-family: monospace;">
                        <option value="">-- Todos --</option>
                        @foreach($authors ?? [] as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones de Acción -->
                <div style="display: flex; gap: 10px;">
                    <button type="submit" style="background: rgba(245, 158, 11, 0.1); border: 1px solid var(--accent); color: var(--accent); padding: 8px 20px; border-radius: 4px; cursor: pointer; font-family: monospace; font-weight: bold; transition: all 0.2s;" onmouseover="this.style.background='var(--accent)'; this.style.color='#000';" onmouseout="this.style.background='rgba(245, 158, 11, 0.1)'; this.style.color='var(--accent)';">
                        [🔍] FILTER
                    </button>
                    
                    @if(request()->hasAny(['search', 'category_id', 'author_id']))
                        <a href="{{ route('library.index') }}" style="background: transparent; border: 1px solid #ff5f56; color: #ff5f56; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-family: monospace; font-size: 0.85rem; display: flex; align-items: center; transition: 0.2s;" onmouseover="this.style.background='#ff5f56'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='#ff5f56';">
                            [X] CLEAR
                        </a>
                    @endif
                </div>
            </form>
        </div>
        <!-- ========================================== -->

        <!-- TABLA RESTAURADA -->
        <div class="table-container">
            <table style="width: 100%; text-align: left; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #333;">
                        <th style="padding: 15px 10px; color: var(--text-secondary); font-size: 0.8rem;">TÍTULO DE LA OBRA</th>
                        <th style="padding: 15px 10px; color: var(--text-secondary); font-size: 0.8rem;">AUTOR</th>
                        <th style="padding: 15px 10px; color: #3b82f6; font-size: 0.8rem;">CATEGORÍA</th>
                        <th style="padding: 15px 10px; color: #10b981; font-size: 0.8rem;">EDITORIAL</th>
                        <th style="padding: 15px 10px; color: var(--text-secondary); font-size: 0.8rem;">AÑO</th>
                        <th style="padding: 15px 10px; color: var(--text-secondary); font-size: 0.8rem;">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr style="border-bottom: 1px solid #1f1f23; transition: background 0.2s;">
                        <td style="padding: 15px 10px; font-weight: bold; color: #e6edf3;">
                            {{ $book->title }}
                        </td>
                        <td style="padding: 15px 10px;">
                            <span class="badge" style="background: #21262d; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; border: 1px solid #30363d;">
                                {{ $book->author->name }}
                            </span>
                        </td>
                        
                        <td style="padding: 15px 10px; font-size: 0.85rem;">
                            <span style="color: #3b82f6;">{{ $book->category ? $book->category->name : '// N/A' }}</span>
                        </td>
                        <td style="padding: 15px 10px; font-size: 0.85rem;">
                            <span style="color: #10b981;">{{ $book->publisher ? $book->publisher->name : '// N/A' }}</span>
                        </td>

                        <td style="padding: 15px 10px; color: #8b949e; font-family: monospace;">
                            {{ $book->published_year }}
                        </td>
                        
                        <td style="padding: 15px 10px; display: flex; gap: 10px; align-items: center;">
                            <a href="{{ route('library.show', $book->id) }}" style="color: var(--accent); text-decoration: none; font-weight: bold; border: 1px solid var(--accent); padding: 5px 10px; border-radius: 4px; font-size: 0.8rem;">
                                > VIEW_FILE
                            </a>

                            @php
                                $isFavorito = $book->bookmarks->where('user_id', Auth::id())->count() > 0;
                            @endphp

                            <form action="{{ route('bookmarks.toggle', $book->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: transparent; border: 1px solid {{ $isFavorito ? '#ff5f56' : '#8b949e' }}; color: {{ $isFavorito ? '#ff5f56' : '#8b949e' }}; padding: 5px 10px; border-radius: 4px; cursor: pointer; transition: all 0.2s; font-size: 0.8rem;" title="{{ $isFavorito ? 'Quitar de Favoritos' : 'Agregar a Favoritos' }}">
                                    {{ $isFavorito ? '♥ SAVED' : '♡ SAVE' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($books->isEmpty())
            <div style="text-align: center; margin-top: 40px; color: var(--text-secondary);">
                <p>// SISTEMA VACÍO. INGRESE DATOS.</p>
            </div>
        @endif
    </div>

</body>
</html>
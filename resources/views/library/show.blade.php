<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FILE: {{ $book->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
</head>
<body style="padding: 40px; background: #09090b; display: flex; justify-content: center; min-height: 100vh;">

    <div class="container" style="max-width: 800px; width: 100%; border-color: var(--accent);">
        
        <!-- ENCABEZADO Y TÍTULO -->
        <header style="border-bottom: 1px dashed var(--accent); padding-bottom: 20px; margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                <a href="{{ route('library.index') }}" style="color: var(--accent); text-decoration: none; font-size: 0.8rem; font-family: monospace; border: 1px dashed var(--accent); padding: 4px 8px; border-radius: 4px; transition: 0.2s;" onmouseover="this.style.background='var(--accent)'; this.style.color='#000';" onmouseout="this.style.background='transparent'; this.style.color='var(--accent)';">
                     [←] GO_BACK
                </a>
            
                <div style="font-size: 0.8rem; color: #8b949e;">
                    > ACCESSING DATABANK... <span style="color: #27c93f;">SUCCESS      </span> 
                </div>


            </div>
            
            <h1 style="font-size: 1.8rem; color: #e6edf3; margin: 0;">
                <span style="color: var(--accent);">FILE_ID_{{ $book->id }}:</span> 
                {{ strtoupper($book->title) }}
            </h1>
        </header>

        <!-- PANELES DE INFORMACIÓN -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 20px;">
            
            <!-- PANEL DE METADATA -->
            <div style="background: #0d1117; padding: 25px; border: 1px solid #30363d; border-radius: 6px;">
                <h3 style="color: #8b949e; font-size: 0.8rem; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid #30363d; padding-bottom: 10px;">> METADATA</h3>
                
                <div style="margin-bottom: 15px;">
                    <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">AUTHOR:</span><br>
                    <span style="font-size: 1.1rem; color: #e6edf3;">{{ $book->author->name }}</span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px;">
                    <div>
                        <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">CATEGORY:</span><br>
                        <span style="font-size: 1rem; color: #3b82f6;">{{ $book->category ? $book->category->name : 'UNCLASSIFIED' }}</span>
                    </div>
                    <div>
                        <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">PUBLISHER:</span><br>
                        <span style="font-size: 1rem; color: #10b981;">{{ $book->publisher ? $book->publisher->name : 'INDEPENDENT' }}</span>
                    </div>
                </div>

                <div style="margin-bottom: 15px;">
                    <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">COLLECTION / SAGA:</span><br>
                    <span style="font-size: 1rem; color: #f59e0b;">{{ $book->collection ? $book->collection->name : 'STANDALONE' }}</span>
                </div>

                <div style="margin-bottom: 15px;">
                    <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">TAGS:</span><br>
                    <div style="margin-top: 5px;">
                        @forelse($book->tags as $tag)
                            <span style="display: inline-block; background: rgba(236, 72, 153, 0.1); color: #ec4899; border: 1px solid #ec4899; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; margin-right: 5px; margin-bottom: 5px;">#{{ $tag->name }}</span>
                        @empty
                            <span style="font-size: 0.85rem; color: #8b949e;">// NO_TAGS_FOUND</span>
                        @endforelse
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <div>
                        <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">YEAR:</span><br>
                        <span style="font-size: 1.1rem; color: #e6edf3;">{{ $book->published_year }}</span>
                    </div>
                    <div style="text-align: right;">
                        <span style="color: #58a6ff; font-size: 0.8rem; letter-spacing: 1px;">ISBN_HASH:</span><br>
                        <span style="font-family: monospace; background: #21262d; padding: 4px 8px; border-radius: 4px; border: 1px solid #30363d; display: inline-block; margin-top: 5px; font-size: 0.85rem;">{{ $book->isbn }}</span>
                    </div>
                </div>
            </div>

            <!-- PANEL DE IMAGEN Y DESCARGA -->
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; border: 1px dashed #30363d; padding: 20px; text-align: center; background: radial-gradient(circle at center, rgba(39, 201, 63, 0.05) 0%, transparent 70%);">
                
                <!-- Si el libro tiene imagen, la mostramos. Si no, mostramos el icono de PDF -->
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Portada de {{ $book->title }}" style="max-width: 100%; max-height: 280px; object-fit: contain; margin-bottom: 20px; border-radius: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); border: 1px solid #30363d;">
                @else
                    <div style="font-size: 4rem; margin-bottom: 15px; opacity: 0.8;">📄</div>
                @endif

                @if($book->file_path)
                    <div style="color: #27c93f; font-weight: bold; margin-bottom: 5px; font-size: 1.1rem; letter-spacing: 1px;">PDF AVAILABLE</div>
                    <div style="font-size: 0.75rem; color: #8b949e;">SECURE STORAGE ENCRYPTED</div>
                @else
                    <div style="color: #ff5f56; font-weight: bold; font-size: 1.1rem; letter-spacing: 1px;">NO DATA</div>
                    <div style="font-size: 0.75rem; color: #8b949e;">FILE CORRUPTED OR MISSING</div>
                @endif
            </div>
        </div>

        <!-- PANEL DE DESCRIPCIÓN (SIEMPRE VISIBLE) -->
        <div style="background: #0d1117; padding: 20px; border: 1px solid #30363d; border-radius: 6px; margin-bottom: 40px;">
            <h3 style="color: #8b949e; font-size: 0.8rem; margin-top: 0; margin-bottom: 10px;">> SYNOPSIS / DESCRIPTION</h3>
            <p style="color: #c9d1d9; font-size: 0.95rem; line-height: 1.7; margin: 0; font-family: 'Outfit', sans-serif;">
                @if($book->description)
                    {{ $book->description }}
                @else
                    <span style="color: #8b949e; font-family: monospace; font-style: italic;">// DATA_CORRUPTED: No se encontró sinopsis en los archivos.</span>
                @endif
            </p>
        </div>

        <!-- BOTONES DE ACCIÓN (Descarga y Volver) -->
        <div style="display: flex; gap: 15px; border-top: 1px solid #30363d; padding-top: 25px;">
            
            @if($book->file_path)
                <!-- NUEVO ENLACE: Apunta a nuestra ruta segura -->
                <a href="{{ route('library.download', $book->id) }}" class="btn-code" style="text-align: center; flex: 2; font-size: 1.1rem; background: #27c93f; color: #000;">
                    [ ↓ DOWNLOAD_PDF ]
                </a>
            @else
                <button disabled class="btn-outline" style="opacity: 0.3; flex: 2; cursor: not-allowed;">FILE_NOT_FOUND</button>
            @endif

            <a href="{{ route('library.index') }}" class="btn-outline" style="text-align: center; flex: 1; display: flex; align-items: center; justify-content: center;">
                ../ RETURN
            </a>
                        <!-- NUEVO: AGREGAR A ESTANTERÍA -->
            @php
                // Truco para traer las estanterías del usuario sin modificar el controlador
                $userShelves = \App\Models\Shelf::where('user_id', Auth::id())->get();
            @endphp
            
            @if($userShelves->count() > 0)
            <form action="{{ route('shelves.addBook', $book->id) }}" method="POST" style="margin: 0; display: flex; flex: 2; gap: 5px;">
                @csrf
                <select name="shelf_id" style="background: #161b22; border: 1px solid #8b5cf6; color: #c9d1d9; border-radius: 4px; padding: 0 10px; font-family: monospace; flex: 1;">
                    <option value="" disabled selected>Seleccionar Estantería...</option>
                    @foreach($userShelves as $shelf)
                        <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                    @endforeach
                </select>
                <button type="submit" style="background: #8b5cf6; color: #fff; border: none; padding: 0 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">+</button>
            </form>
            @endif

        </div>



        <!-- ========================================== -->
        <!-- SECCIÓN DE RESEÑAS Y CALIFICACIONES -->
        <!-- ========================================== -->
        <div style="margin-top: 50px; border-top: 1px dashed #30363d; padding-top: 30px;">
            <h3 style="color: #e6edf3; font-size: 1.2rem; margin-bottom: 20px;">
                <span style="color: #e3b341;">★</span> COMMUNITY_REVIEWS
            </h3>

            <!-- Formulario de Transmisión -->
            <div style="background: #161b22; padding: 20px; border: 1px solid #30363d; border-radius: 6px; margin-bottom: 30px;">
                <h4 style="color: #8b949e; margin-top: 0; margin-bottom: 15px; font-size: 0.9rem;">> SUBMIT_TRANSMISSION</h4>
                
                @if(session('success'))
                    <div style="color: #27c93f; font-size: 0.85rem; margin-bottom: 15px; font-family: monospace;">> {{ session('success') }}</div>
                @endif

                <form action="{{ route('reviews.store', $book->id) }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 15px;">
                        <label style="color: #58a6ff; font-size: 0.8rem; display: block; margin-bottom: 5px;">RATING (1-5)</label>
                        <select name="rating" required style="width: 100%; max-width: 300px; background: #0d1117; border: 1px solid #30363d; color: #e3b341; padding: 10px; border-radius: 4px;">
                            <option value="5">★★★★★ - Excelente</option>
                            <option value="4">★★★★☆ - Muy bueno</option>
                            <option value="3">★★★☆☆ - Bueno</option>
                            <option value="2">★★☆☆☆ - Regular</option>
                            <option value="1">★☆☆☆☆ - Malo</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="color: #58a6ff; font-size: 0.8rem; display: block; margin-bottom: 5px;">COMMENT (Optional)</label>
                        <textarea name="comment" rows="3" placeholder="Ingresa tu análisis de esta obra..." style="width: 100%; box-sizing: border-box; background: #0d1117; border: 1px solid #30363d; color: #c9d1d9; padding: 12px; border-radius: 4px; font-family: inherit; resize: vertical;"></textarea>
                    </div>

                    <button type="submit" class="btn-outline" style="border-color: #58a6ff; color: #58a6ff; padding: 8px 20px; font-size: 0.85rem;">
                        [+] TRANSMIT_REVIEW
                    </button>
                </form>
            </div>

            <!-- Tablón de Comentarios -->
            <div style="display: flex; flex-direction: column; gap: 15px;">
                @forelse($book->reviews as $review)
                    <div style="background: #0d1117; border: 1px solid #30363d; padding: 20px; border-left: 3px solid #58a6ff; border-radius: 4px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <div>
                                <span style="font-weight: bold; color: #e6edf3; font-size: 1.1rem;">{{ $review->user->name }}</span>
                                <span style="color: #8b949e; font-size: 0.8rem; margin-left: 10px; font-family: monospace;">{{ $review->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div style="color: #e3b341; font-size: 1.1rem; letter-spacing: 2px;">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                        </div>
                        
                        @if($review->comment)
                            <p style="color: #c9d1d9; font-size: 0.95rem; line-height: 1.6; margin: 0; font-family: 'Courier New', Courier, monospace;">
                                "{{ $review->comment }}"
                            </p>
                        @endif

                        @if(Auth::id() === $review->user_id || Auth::user()->role === 'bibliotecario')
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="margin-top: 15px; text-align: right;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: transparent; border: none; color: #ff5f56; font-size: 0.75rem; cursor: pointer; text-decoration: underline; font-family: monospace;">
                                    [DELETE_RECORD]
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div style="color: #8b949e; font-family: monospace; text-align: center; padding: 30px; border: 1px dashed #30363d;">
                        // NO_REVIEWS_FOUND. BE_THE_FIRST.
                    </div>
                @endforelse
            </div>
        </div>

              <!-- ========================================== -->
        <!-- SISTEMA DE REPORTES DE ERROR -->
        <!-- ========================================== -->
        <div style="margin-top: 50px; border-top: 1px dashed #ff5f56; padding-top: 30px;">
            <h4 style="color: #ff5f56; font-size: 0.9rem; margin-bottom: 15px;">> FILE_CORRUPTED? REPORT_ISSUE</h4>
            
            <form action="{{ route('reports.store', $book->id) }}" method="POST" style="background: rgba(255, 95, 86, 0.05); padding: 15px; border: 1px solid #ff5f56; border-radius: 6px;">
                @csrf
                <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
                    <div style="flex: 1; min-width: 200px;">
                        <label style="color: #ff5f56; font-size: 0.75rem; font-family: monospace;">TIPO DE FALLA</label>
                        <select name="issue_type" required style="width: 100%; box-sizing: border-box; background: #0d1117; border: 1px solid #ff5f56; color: #c9d1d9; padding: 8px; border-radius: 4px; font-family: monospace; margin-top: 5px;">
                            <option value="Archivo dañado o no abre">Archivo dañado o no abre</option>
                            <option value="Enlace de descarga roto">Enlace de descarga roto</option>
                            <option value="Contenido incorrecto (No es el libro)">Contenido incorrecto (No es el libro)</option>
                            <option value="Faltan páginas / Ilegible">Faltan páginas / Ilegible</option>
                            <option value="Otro">Otro problema</option>
                        </select>
                    </div>
                    <div style="flex: 2; min-width: 250px;">
                        <label style="color: #ff5f56; font-size: 0.75rem; font-family: monospace;">DETALLES (OPCIONAL)</label>
                        <input type="text" name="description" placeholder="Ej. El PDF se corta en la página 40..." style="width: 100%; box-sizing: border-box; background: #0d1117; border: 1px solid #ff5f56; color: #c9d1d9; padding: 8px; border-radius: 4px; font-family: monospace; margin-top: 5px;">
                    </div>
                    <div>
                        <button type="submit" style="background: transparent; border: 1px solid #ff5f56; color: #ff5f56; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-family: monospace; font-weight: bold; transition: all 0.2s;" onmouseover="this.style.background='#ff5f56'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='#ff5f56';">
                            [!] SUBMIT_REPORT
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
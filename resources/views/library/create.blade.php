<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso de Obra - TITAN</title>
    <link rel="stylesheet" href="{{ asset('css/titan.css') }}">
    <style>
        /* Estilos para los checkboxes de Tags */
        .tags-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            background: #0d1117;
            padding: 15px;
            border: 1px solid #30363d;
            border-radius: 4px;
            max-height: 150px;
            overflow-y: auto;
        }
        .tag-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #c9d1d9;
            font-size: 0.85rem;
            font-family: monospace;
        }
    </style>
</head>
<body class="landing-body" style="padding: 40px; display: flex; justify-content: center;">

    <div class="container" style="max-width: 800px; width: 100%;">
        <header style="justify-content: center; border-bottom: 1px dashed var(--border); padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="font-size: 1.5rem; margin: 0;"><span>✚</span> REGISTRO DE DATOS</h1>
        </header>

        <form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- TÍTULO -->
            <div style="margin-bottom: 24px;">
                <label>Título de la Obra</label>
                <input type="text" name="title" required placeholder="Ej. Clean Code" autocomplete="off" style="width: 100%; box-sizing: border-box;">
            </div>

            <!-- DESCRIPCIÓN (NUEVO) -->
            <div style="margin-bottom: 24px;">
                <label>Descripción / Sinopsis (Opcional)</label>
                <textarea name="description" rows="4" placeholder="Breve resumen o contraportada del libro..." style="width: 100%; box-sizing: border-box; background: #0d1117; border: 1px solid #30363d; color: #c9d1d9; padding: 12px; border-radius: 4px; font-family: inherit; margin-top: 5px; resize: vertical;"></textarea>
            </div>

            <!-- AUTOR -->
            <div style="margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                    <label>Autor Principal</label>
                    <a href="{{ route('library.createAuthor') }}" style="font-size: 0.75rem; color: #a855f7; text-decoration: none; border: 1px solid #a855f7; padding: 2px 8px; border-radius: 4px;">
                        + NUEVO AUTOR
                    </a>
                </div>
                <select name="author_id" required style="width: 100%; box-sizing: border-box;">
                    <option value="" disabled selected>-- Seleccione un autor --</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- CLASIFICACIÓN (Cat, Pub, Col) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 24px;">
                <div>
                    <label style="color: #3b82f6;">Categoría</label>
                    <select name="category_id" style="width: 100%; box-sizing: border-box; border-color: #1d4ed8;">
                        <option value="">-- N/A --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="color: #10b981;">Editorial</label>
                    <select name="publisher_id" style="width: 100%; box-sizing: border-box; border-color: #047857;">
                        <option value="">-- N/A --</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="color: #f59e0b;">Saga / Colección</label>
                    <select name="collection_id" style="width: 100%; box-sizing: border-box; border-color: #b45309;">
                        <option value="">-- N/A --</option>
                        @foreach($collections as $collection)
                            <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- ETIQUETAS (TAGS) -->
            <div style="margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                    <label style="color: #ec4899;">Etiquetas (Opcional)</label>
                    <a href="{{ route('tags.create') }}" style="font-size: 0.75rem; color: #ec4899; text-decoration: none; border: 1px solid #ec4899; padding: 2px 8px; border-radius: 4px;">
                        + NUEVA ETIQUETA
                    </a>
                </div>
                
                <div class="tags-grid" style="border-color: #be185d;">
                    @forelse($tags as $tag)
                        <label class="tag-item">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> 
                            #{{ $tag->name }}
                        </label>
                    @empty
                        <span style="color: #8b949e; font-size: 0.8rem;">// No hay etiquetas registradas</span>
                    @endforelse
                </div>
            </div>

            <!-- ARCHIVOS: PDF E IMAGEN (NUEVO) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                <!-- ARCHIVO PDF -->
                <div style="border: 1px dashed var(--accent); padding: 15px; border-radius: 6px; background: rgba(245, 158, 11, 0.05);">
                    <label style="color: var(--accent);">Archivo Fuente (PDF) *</label>
                    <input type="file" name="book_file" accept=".pdf" required style="background: transparent; border: none; padding-left: 0; width: 100%; box-sizing: border-box; color: #fff; margin-top: 10px;">
                </div>

                <!-- PORTADA (IMAGEN) -->
                <div style="border: 1px dashed #a855f7; padding: 15px; border-radius: 6px; background: rgba(168, 85, 247, 0.05);">
                    <label style="color: #a855f7;">Portada (Imagen Opcional)</label>
                    <input type="file" name="cover_image" accept="image/png, image/jpeg, image/jpg, image/webp" style="background: transparent; border: none; padding-left: 0; width: 100%; box-sizing: border-box; color: #fff; margin-top: 10px;">
                </div>
            </div>

            <!-- AÑO E ISBN -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                <div>
                    <label>Año de Publicación</label>
                    <input type="number" name="published_year" required placeholder="Ej. 2024" style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label>Código ISBN</label>
                    <input type="text" name="isbn" required placeholder="Ej. 978-3-16-148410-0" style="width: 100%; box-sizing: border-box;">
                </div>
            </div>

            <!-- BOTONES -->
            <div style="display: flex; gap: 15px;">
                <a href="{{ route('library.index') }}" class="btn-outline" style="text-align: center; width: 30%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                    CANCELAR
                </a>
                <button type="submit" class="btn-code" style="width: 70%; font-weight: bold; letter-spacing: 1px; padding: 15px;">
                    CONFIRMAR INGRESO
                </button>
            </div>
        </form>
    </div>

</body>
</html>
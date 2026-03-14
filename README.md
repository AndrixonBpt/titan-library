# ◼️ TITAN Library (Dev_Archive)

TITAN Library es un Sistema de Gestión de Biblioteca Digital nivel Enterprise construido sobre Laravel. Diseñado bajo un concepto de "Repositorio de Conocimiento Hacker/Cyberpunk", cuenta con una arquitectura robusta basada en el patrón MVC y principios SOLID.

## 🚀 Características Principales

El proyecto escala una simple biblioteca a una plataforma interactiva completa:

* **Arquitectura Escalable:** 12 Modelos relacionales (1:N y N:M) y 14 Controladores con Responsabilidad Única.
* **Control de Acceso (ACL):** Sistema de roles mediante AdminMiddleware. (Bibliotecario vs. Lector).
* **Taxonomía Avanzada:** Clasificación de archivos por Categorías, Editoriales, Colecciones (Sagas) y Etiquetas (Hashtags).
* **Centro de Mando (Dashboard):** Panel analítico para el administrador con seguimiento invisible de descargas (Download Logs) y KPIs.
* **Interacción Comunitaria:**
  * Sistema de Favoritos y Estanterías Personalizadas (Playlists de libros).
  * Sistema de Reseñas y Calificaciones (1-5 estrellas) con protección anti-spam a nivel de base de datos.
* **Módulo de Soporte:** Sistema de tickets internos para solicitar libros nuevos (BookRequests) o reportar archivos dañados (Reports).
* **UI/UX Custom:** Sistema de diseño nativo en CSS puro (CSS Variables, Flexbox, Grid), sin depender de frameworks externos como Bootstrap o Tailwind.

## 🛠️ Instalación y Despliegue Local

Sigue estos pasos para levantar el entorno TITAN en tu máquina local:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/tu-usuario/titan-library.git](https://github.com/tu-usuario/titan-library.git)
   cd titan-library
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar el entorno:**
   Duplica el archivo de ejemplo y configura tu conexión a la base de datos (MySQL).
   ```bash
   cp .env.example .env
   ```
   Abre `.env` y asegúrate de configurar `DB_DATABASE=bibliopop` (o el nombre de tu DB).

4. **Generar la llave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Crear el enlace de almacenamiento (Storage Link):**
   Vital para la subida y lectura de archivos PDF.
   ```bash
   php artisan storage:link
   ```

6. **Construir la Base de Datos y sembrar datos de prueba:**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Iniciar el servidor local:**
   ```bash
   php artisan serve
   ```
   Visita `http://127.0.0.1:8000` en tu navegador.

## 🔐 Credenciales de Prueba (Seeders)

El sistema genera automáticamente usuarios con diferentes roles para facilitar las pruebas:

| Rol | Email | Contraseña |
| :--- | :--- | :--- |
| Administrador | admin@titan.com | 12345678 |
| Lector (User) | neo@titan.com | 12345678 |

## 🏗️ Estructura de la Base de Datos

El sistema implementa relaciones complejas gestionadas a través de Eloquent ORM:

* **Uno a Muchos (1:N):** Autores, Categorías, Editoriales y Colecciones hacia Libros.
* **Muchos a Muchos (N:M):** Etiquetas (tags) y Estanterías (shelves) conectadas a Libros mediante tablas pivote (`book_tag`, `book_shelf`).

> Desarrollado con fines académicos y de demostración técnica.
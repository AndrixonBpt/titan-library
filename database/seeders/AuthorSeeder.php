<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author; // ¡Importante importar el modelo!

class AuthorSeeder extends Seeder
{
    public function run()
    {
        // Limpiamos la tabla antes de sembrar (opcional)
        // Author::truncate(); 

        $authors = [
            ['name' => 'Robert C. Martin', 'biography' => 'Ingeniero de software y autor de Clean Code.'],
            ['name' => 'Isaac Asimov', 'biography' => 'Padre de las leyes de la robótica.'],
            ['name' => 'Ada Lovelace', 'biography' => 'La primera programadora de la historia.'],
            ['name' => 'H.P. Lovecraft', 'biography' => 'Maestro del terror cósmico.'],
            ['name' => 'Philip K. Dick', 'biography' => 'Autor de ¿Sueñan los androides con ovejas eléctricas?'],
            ['name' => 'Linus Torvalds', 'biography' => 'Creador del kernel Linux.']
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}

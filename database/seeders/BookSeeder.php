<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Buscamos el primer autor (o creamos uno si no hay)
        $author = Author::first() ?? Author::create(['name' => 'Robert C. Martin']);

        Book::create([
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'isbn' => '9780132350884',
            'published_year' => 2008,
            'author_id' => $author->id,
            // file_path se queda nulo (NULL) porque son libros de prueba sin PDF real
        ]);

        Book::create([
            'title' => 'The Pragmatic Programmer',
            'isbn' => '9780201616224',
            'published_year' => 1999,
            'author_id' => $author->id,
        ]);
    }
}

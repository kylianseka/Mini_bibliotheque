<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Book::create([
            'title' => 'Les Misérables',
            'author' => 'Victor Hugo',
            'isbn' => '978-2070409228',
            'published_year' => 1862,
            'description' => 'Un chef-d\'œuvre de la littérature française.',
            'quantity' => 5,
            'available_quantity' => 5,
        ]);

        \App\Models\Book::create([
            'title' => 'Le Petit Prince',
            'author' => 'Antoine de Saint-Exupéry',
            'isbn' => '978-2070612758',
            'published_year' => 1443,
            'description' => 'Un conte poétique et philosophique.',
            'quantity' => 3,
            'available_quantity' => 3,
        ]);

        \App\Models\Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'isbn' => '978-0451524935',
            'published_year' => 1949,
            'description' => 'Un roman d\'anticipation glaçant.',
            'quantity' => 4,
            'available_quantity' => 4,
        ]);
    }
}

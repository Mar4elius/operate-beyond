<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Library;
use Database\Factories\AuthorFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Author::factory()->count(10)->create();
        Book::factory()->count(10)->create();
        Library::factory()->count(10)->create();

        // populate book_library table
        $books = Book::all();
        Library::all()->each(function ($library) use ($books) {
            $library->books()->attach(
                $books->random(2)->pluck('id')->toArray()
            );
        });
    }
}

<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Library;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test Book store functionality with author provided
     *
     * @return void
     */
    public function test_book_store_with_author(): void
    {
        $new_book = Book::factory()->make();
        $author = Author::factory()->create();

        $payload = [
            'name' => $new_book->name,
            'year' => $new_book->year,
            'author_id' => $author->id,
        ];

        $response = $this->post('api/v1/books', $payload);
        $response->assertStatus(200);

        $book = $response->getOriginalContent()['book'];

        // Check if record is stored in the database
        $this->assertEquals($book->id, Book::find($book->id)->id);
    }

    /**
     * Test Book store functionality with author and library provided
     *
     * @return void
     */
    public function test_book_store_with_author_and_library(): void
    {
        $new_book = Book::factory()->make();
        $author = Author::factory()->create();
        $library = Library::factory()->create();

        $payload = [
            'name' => $new_book->name,
            'year' => $new_book->year,
            'author_id' => $author->id,
            'library'   => $library->id
        ];

        $response = $this->post('api/v1/books', $payload);
        $response->assertStatus(200);

        $book = $response->getOriginalContent()['book'];

        // Check if record is stored in the database
        $this->assertEquals($book->id, Book::find($book->id)->id);
    }
}

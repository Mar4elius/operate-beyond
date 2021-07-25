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
     * Test book search functionality
     *
     * @return void
     */
    public function test_book_search(): void
    {
        $response = $this->get('api/v1/books/search');
        $response->assertStatus(200);
        $this->assertIsArray($response['books']);
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

    /**
     * Test book destroy functionality
     *
     * @return void
     */
    public function test_book_destroy(): void
    {
        $book = Book::factory()->create();

        $response = $this->delete("api/v1/books/{$book->id}");
        $response->assertStatus(200);
    }

    /**
     * Test Book update functionality
     *
     * @return void
     */
    public function test_book_update_with_author(): void
    {
        $new_book = Book::factory()->create();

        $new_book->name = 'Update Test Book';
        $new_book->author_id = $new_book->author_id === 1 ?: 2;
        $new_book->year = 9999;

        $response = $this->patch("api/v1/books/{$new_book->id}", $new_book->toArray());
        $response->assertStatus(200);

        $this->assertDatabaseHas('books', [
            'id'            => $new_book->id,
            'name'          => 'Update Test Book',
            'author_id'     => $new_book->author_id,
            'year'          => 9999,
        ]);
    }

    /**
     * Test Book update functionality
     *
     * @return void
     */
    public function test_book_update_with_library(): void
    {
        $new_book = Book::factory()->create();
        $new_library = Library::factory()->create();

        $new_book->name = 'Update Book Library';
        $new_book->author_id = $new_book->author_id === 1 ?: 2;
        $new_book->year = 9999;
        $new_book->library_id = $new_library->id;

        $response = $this->patch("api/v1/books/{$new_book->id}", $new_book->toArray());
        $response->assertStatus(200);

        $this->assertDatabaseHas('books', [
            'id'            => $new_book->id,
            'name'          => 'Update Book Library',
            'author_id'     => $new_book->author_id,
            'year'          => 9999,
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
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
     * Test author search functionality
     *
     * @return void
     */
    public function test_author_search(): void
    {
        $response = $this->get('api/v1/authors/search');
        $response->assertStatus(200);
        $this->assertIsArray($response['authors']);
    }

    /**
     * Test Author store functionality
     *
     * @return void
     */
    public function test_author_store(): void
    {
        $new_author = Author::factory()->make();

        $response = $this->post('api/v1/authors', $new_author->toArray());
        $response->assertStatus(200);

        //Check if record is stored in the database
        $author = $response->getOriginalContent()['author'];
        $this->assertEquals($author->id, Author::find($author->id)->id);
    }

    /**
     * Test Author update functionality
     *
     * @return void
     */
    public function test_author_update(): void
    {
        $new_author = Author::factory()->create();

        $new_author->name = 'Update Test Author';
        $new_author->birth_date = Carbon::now();
        $new_author->genre =  $new_author->genre != 'Fiction' ?: 'Novel'; // so to avoid `Failed asserting that a row in the table [authors] matches the attributes` error

        $response = $this->patch("api/v1/authors/{$new_author->id}", $new_author->toArray());
        $response->assertStatus(200);

        $this->assertDatabaseHas('authors', [
            'id' => $new_author->id,
            'name' => 'Update Test Author',
            'birth_date'  => Carbon::now(),
            'genre'  => 'Fiction'
        ]);
    }
}

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
}

<?php

namespace Tests\Feature;

use App\Models\Library;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibraryTest extends TestCase
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
     * Test Library store functionality
     *
     * @return void
     */
    public function test_library_store(): void
    {
        $new_library = Library::factory()->make();
        $response = $this->post('api/v1/libraries', $new_library->toArray());
        $response->assertStatus(200);

        //Check if record is stored in the database
        $library = $response->getOriginalContent()['library'];
        $this->assertEquals($library->id, Library::find($library->id)->id);
    }
}

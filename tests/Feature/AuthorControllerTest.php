<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCaseFeature;

class AuthorControllerTest extends TestCaseFeature
{
    use RefreshDatabase;

    public function test_can_list_authors()
    {
        Author::factory()->create(['name' => 'John Doe']);

        $response = $this->get('/authors');

        $response->assertStatus(200)
            ->assertSee('John Doe');
    }

    public function test_can_create_author()
    {
        $response = $this->postJson('/authors', [
            'name' => 'Jane Doe',
            'url'  => 'https://example.com',
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('authors', ['name' => 'Jane Doe']);
    }

    public function test_can_update_author()
    {
        $author = Author::factory()->create(['name' => 'Old Name']);

        $response = $this->putJson("/authors/{$author->id}", [
            'name' => 'Updated Name',
            'url'  => 'https://new-url.com',
        ]);

        $response->assertStatus(302); // Redirect after update
        $this->assertDatabaseHas('authors', ['name' => 'Updated Name']);
    }

    public function test_can_delete_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/authors/{$author->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}

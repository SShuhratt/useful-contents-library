<?php

namespace Tests\Feature;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCaseFeature;

class GenreControllerTest extends TestCaseFeature
{
    use RefreshDatabase;

    public function test_can_list_genres()
    {
        Genre::factory()->create(['name' => 'Science Fiction']);

        $response = $this->get('/genres');

        $response->assertStatus(200)
            ->assertSee('Science Fiction');
    }

    public function test_can_create_genre()
    {
        $response = $this->post('/genres', [
            'name' => 'Fantasy',
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('genres', ['name' => 'Fantasy']);
    }

    public function test_can_update_genre()
    {
        $genre = Genre::factory()->create(['name' => 'Old Genre']);

        $response = $this->put("/genres/{$genre->id}", [
            'name' => 'Updated Genre',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('genres', ['name' => 'Updated Genre']);
    }

    public function test_can_delete_genre()
    {
        $genre = Genre::factory()->create();

        $response = $this->delete("/genres/{$genre->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
    }
}

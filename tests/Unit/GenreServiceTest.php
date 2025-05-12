<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Genre;
use App\Services\GenreService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenreServiceTest extends TestCase
{
    use RefreshDatabase;

    protected GenreService $genreService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->genreService = new GenreService();
    }

    public function createGenreTest()
    {
        $genre = $this->genreService->createGenre(['name' => 'Fantasy']);

        $this->assertDatabaseHas('genres', ['name' => 'Fantasy']);
        $this->assertEquals('Fantasy', $genre->name);
    }

    public function updateGenreTest()
    {
        $genre = Genre::factory()->create(['name' => 'Old Name']);

        $this->genreService->updateGenre($genre, ['name' => 'New Name']);

        $this->assertDatabaseHas('genres', ['name' => 'New Name']);
    }

    public function deleteGenreTest()
    {
        $genre = Genre::factory()->create();

        $this->genreService->deleteGenre($genre);

        $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
    }

    public function genreSearchTest()
    {
        Genre::factory()->create(['name' => 'Sci-Fi']);
        Genre::factory()->create(['name' => 'Romance']);

        $results = $this->genreService->getGenres('sci');

        $this->assertCount(1, $results);
        $this->assertEquals('Sci-Fi', $results->first()->name);
    }
}

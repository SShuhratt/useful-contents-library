<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AuthorService $authorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authorService = new AuthorService();
    }

    public function createAuthorTest()
    {
        $data = [
            'name' => 'Test Author',
            'url' => 'https://example.com',
        ];

        $author = $this->authorService->createAuthor($data);

        $this->assertDatabaseHas('authors', ['name' => 'Test Author']);
        $this->assertEquals('https://example.com', $author->url);
    }

    public function updateAuthorTest()
    {
        $author = Author::factory()->create([
            'name' => 'Old Name',
        ]);

        $this->authorService->updateAuthor($author, ['name' => 'New Name']);

        $this->assertDatabaseHas('authors', ['name' => 'New Name']);
    }

    public function deleteAuthorTest()
    {
        $author = Author::factory()->create();

        $this->authorService->deleteAuthor($author);

        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    public function authorSearchTest()
    {
        Author::factory()->create(['name' => 'Alice']);
        Author::factory()->create(['name' => 'Bob']);

        $results = $this->authorService->getAuthors('Ali');

        $this->assertCount(1, $results);
        $this->assertEquals('Alice', $results->first()->name);
    }
}


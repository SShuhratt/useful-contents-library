<?php

namespace Tests\Feature;

use App\Models\Content;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCaseFeature;
use App\Models\Author;
use App\Models\Genre;

class ContentControllerTest extends TestCaseFeature
{
    use RefreshDatabase;

    public function test_can_list_contents()
    {
        Content::factory()->create(['title' => 'Sample Content']);

        $response = $this->get('/contents');

        $response->assertStatus(200)
            ->assertSee('Sample Content');
    }

    public function test_can_create_content()
    {
        $category = Category::factory()->create();
        $author = Author::factory()->create();
        $genre = Genre::factory()->create();

        $response = $this->post('/contents', [
            'title'       => 'New Content',
            'description' => 'Sample description',
            'url'         => 'https://example.com',
            'category_id' => $category->id,
            'authors'     => [$author->id],
            'genres'      => [$genre->id],
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('contents', ['title' => 'New Content']);
    }


    public function test_can_update_content()
    {
        $content = Content::factory()->create(['title' => 'Old Title']);
        $author = Author::factory()->create();
        $genre = Genre::factory()->create();

        $response = $this->put("/contents/{$content->id}", [
            'title'       => 'Updated Title',
            'description' => 'Updated description',
            'url'         => 'https://new-url.com',
            'category_id' => $content->category_id,
            'authors'     => [$author->id],
            'genres'      => [$genre->id],
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('contents', ['title' => 'Updated Title']);
    }


    public function test_can_delete_content()
    {
        $content = Content::factory()->create();

        $response = $this->delete("/contents/{$content->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('contents', ['id' => $content->id]);
    }
}

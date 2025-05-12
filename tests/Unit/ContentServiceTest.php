<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Content;
use App\Models\Category;
use App\Services\ContentService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ContentService $contentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->contentService = new ContentService();
    }

    public function createContentTest()
    {
        $category = Category::factory()->create();

        $data = [
            'title' => 'Sample Title',
            'description' => 'Sample description here.',
            'url' => 'https://example.com',
            'category_id' => $category->id,
        ];

        $content = $this->contentService->createContent($data);

        $this->assertDatabaseHas('contents', ['title' => 'Sample Title']);
        $this->assertEquals($data['url'], $content->url);
    }

    public function updateContentTest()
    {
        $content = Content::factory()->create(['title' => 'Old Title']);

        $this->contentService->updateContent($content, ['title' => 'New Title']);

        $this->assertDatabaseHas('contents', ['title' => 'New Title']);
    }

    public function deleteContentTest()
    {
        $content = Content::factory()->create();

        $this->contentService->deleteContent($content);

        $this->assertDatabaseMissing('contents', ['id' => $content->id]);
    }

    public function searchContentTest()
    {
        Content::factory()->create(['title' => 'Laravel Tips']);
        Content::factory()->create(['title' => 'Other Title']);

        $results = $this->contentService->getContents('Tips');

        $this->assertCount(1, $results);
        $this->assertEquals('Laravel Tips', $results->first()->title);
    }

    public function createFakeContentTest()
    {
        Category::factory()->create(); // Needed for inRandomOrder() to work
        $content = $this->contentService->createContent([], true);

        $this->assertNotEmpty($content->title);
        $this->assertDatabaseHas('contents', ['id' => $content->id]);
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected CategoryService $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryService = new CategoryService();
    }

    public function createCategoryTest()
    {
        $data = ['name' => 'History'];
        $category = $this->categoryService->createCategory($data);

        $this->assertDatabaseHas('categories', ['name' => 'History']);
        $this->assertEquals('History', $category->name);
    }

    public function updateCategoryTest()
    {
        $category = Category::factory()->create(['name' => 'Old']);

        $this->categoryService->updateCategory($category, ['name' => 'New']);

        $this->assertDatabaseHas('categories', ['name' => 'New']);
    }

    public function deleteCategoryTest()
    {
        $category = Category::factory()->create();

        $this->categoryService->deleteCategory($category);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function categorySearchTest()
    {
        Category::factory()->create(['name' => 'Science']);
        Category::factory()->create(['name' => 'Arts']);

        $results = $this->categoryService->getCategories('sci');

        $this->assertCount(1, $results);
        $this->assertEquals('Science', $results->first()->name);
    }
}


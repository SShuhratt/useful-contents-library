<?php

namespace Tests\Feature;

use Tests\TestCaseFeature;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCaseFeature
{
    use RefreshDatabase;

    public function test_can_list_categories()
    {
        Category::factory()->create(['name' => 'Fiction']);

        $response = $this->get('/categories');

        $response->assertStatus(200)
            ->assertSee('Fiction');
    }

    public function test_can_create_category()
    {
        $response = $this->post('/categories', [
            'name' => 'Science Fiction',
        ]);

        $response->assertStatus(302); // Assuming redirect after storing
        $this->assertDatabaseHas('categories', [
            'name' => 'Science Fiction',
        ]);
    }

    public function test_can_update_category()
    {
        $category = Category::factory()->create(['name' => 'Old Name']);

        $response = $this->put("/categories/{$category->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(302); // Assuming redirect after updating
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete("/categories/{$category->id}");

        $response->assertStatus(302); // Assuming redirect after deletion
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}

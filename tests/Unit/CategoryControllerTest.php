<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_a_list_of_categories()
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         '*' => [
                             'id',
                             'name',
                             // Other fields...
                         ],
                     ],
                 ]);
    }

    /** @test */
    public function it_creates_a_new_category()
    {
        $categoryData = [
            'name' => 'Test Category',
        ];

        $response = $this->postJson('/api/categories', $categoryData);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'data' => [
                         'name' => 'Test Category',
                         // Other fields...
                     ],
                 ]);

        $this->assertDatabaseHas('categories', $categoryData);
    }

    /** @test */
    public function it_displays_a_specific_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson('/api/categories/' . $category->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'data' => [
                         'id' => $category->id,
                         'name' => $category->name,
                         // Other fields...
                     ],
                 ]);
    }

    /** @test */
    public function it_updates_a_category()
    {
        $category = Category::factory()->create();

        $updatedData = [
            'name' => 'Updated Category Name',
        ];

        $response = $this->putJson('/api/categories/' . $category->id, $updatedData);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'data' => [
                         'id' => $category->id,
                         'name' => 'Updated Category Name',
                         // Other fields...
                     ],
                 ]);

        $this->assertDatabaseHas('categories', $updatedData);
    }

    /** @test */
    public function it_deletes_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson('/api/categories/' . $category->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Category deleted successfully',
                 ]);

        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
        ]);
    }

    /** @test */
    public function it_restores_a_deleted_category()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->postJson('/api/categories/restore/' . $category->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Category restored successfully',
                     'data' => [
                         'id' => $category->id,
                         // Other fields...
                     ],
                 ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_force_deletes_a_category()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->deleteJson('/api/categories/force-delete/' . $category->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Category force deleted successfully',
                 ]);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}

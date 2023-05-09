<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if all routes for the 'categories' resource return a 200 status code
     *
     * @return void
     */
    public function test_all_categories_routes_return_200_status_code()
    {
        // Create a category to test with
        $category = Category::factory()->create();

        // Test the index route
        $response = $this->get('/categories');
        $response->assertStatus(200);

        // Test the create route
        $response = $this->get('/categories/create');
        $response->assertStatus(200);

        // Test the store route
        $response = $this->post('/categories', [
            'name' => 'New Category',
            'image' => fake()->imageUrl()
        ]);
        $response->assertStatus(302); // Should redirect after a successful post

        // Test the show route
        $response = $this->get('/categories/' . $category->id);
        $response->assertStatus(200);

        // Test the edit route
        $response = $this->get('/categories/' . $category->id . '/edit');
        $response->assertStatus(200);

        // Test the update route
        $response = $this->put('/categories/' . $category->id, [
            'name' => 'Updated Category',
            'image' => fake()->imageUrl()
        ]);
        $response->assertStatus(302); // Should redirect after a successful put

        // Test the destroy route
        $response = $this->delete('/categories/' . $category->id);
        $response->assertStatus(302); // Should redirect after a successful delete
    }
}

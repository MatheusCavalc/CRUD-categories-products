<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if all routes for the 'products' resource return a 200 status code
     *
     * @return void
     */
    public function test_all_products_routes_return_200_status_code()
    {
        // Create a product to test with
        $product = Product::factory()->create();

        // Create a category to test with
        $category = Category::factory()->create();

        // Test the index route
        $response = $this->get('/products');
        $response->assertStatus(200);

        // Test the create route
        $response = $this->get('/products/create');
        $response->assertStatus(200);

        // Test the store route
        $response = $this->post('/products', [
            'name' => 'New Category',
            'image' => fake()->imageUrl(),
            'category_id' => $category->id
        ]);
        $response->assertStatus(302); // Should redirect after a successful post

        // Test the show route
        $response = $this->get('/products/' . $product->id);
        $response->assertStatus(200);

        // Test the edit route
        $response = $this->get('/products/' . $product->id . '/edit');
        $response->assertStatus(200);

        // Test the update route
        $response = $this->put('/products/' . $product->id, [
            'name' => 'Updated Category',
            'image' => fake()->imageUrl(),
            'category_id' => $category->id
        ]);
        $response->assertStatus(302); // Should redirect after a successful put

        // Test the destroy route
        $response = $this->delete('/products/' . $product->id);
        $response->assertStatus(302); // Should redirect after a successful delete
    }
}

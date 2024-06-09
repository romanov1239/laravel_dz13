<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_products_can_be_indexed()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }

    public function test_product_can_be_shown()
    {
        $product = Product::factory()->create();

        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200);
    }

    public function test_product_can_be_stored()
    {
        $productData = [
            'sku' => 'SKU123',
            'name' => 'Test Product',
            'price' => 9.99,
        ];

        $response = $this->post('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJsonFragment($productData);
    }

    public function test_product_can_be_updated()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product Name',
            'price' => 19.99,
        ];

        $response = $this->put("/api/products/{$product->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);
    }

    public function test_product_can_be_destroyed()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/api/products/{$product->id}");

        $response->assertStatus(204);
    }

}

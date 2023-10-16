<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tests\Traits\WithUserAndAdmin;

class ProductTest extends TestCase
{

    use RefreshDatabase;
    use WithUserAndAdmin;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUserAndAdmin();
    }

    /**
     * A basic feature test example.
     */
    public function test_api_returns_products_list(): void
    {

        $product_1 = Product::factory()->create([
            'name' => 'Product 1',
            'price' => 1500
        ]);

        $product_2 = Product::factory()->create([
            'name' => 'Product 2',
            'price' => 2000
        ]);

        $response = $this->actingAs($this->admin)->getJson('/api/products');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 2)
                ->has('data.0', fn (AssertableJson $json) =>
                    $json->where('name', $product_1->name)
                        ->where('price', $product_1->price)
                        ->where('created_at', $product_1->created_at->toDateString())
                        ->where('updated_at', $product_1->updated_at->toDateString())
                        ->etc()
            )
        );
    }

    public function test_api_product_store_successful(): void
    {

        $product = [
            'name' => 'Product 2',
            'price' => 20000,
            'description' => 'What an amazing product'
        ];

        $response = $this->actingAs($this->admin)->postJson('/api/products', $product);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $product);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data')
            ->has('data', fn (AssertableJson $json) =>
                $json->where('name', 'Product 2')
                    ->where('price', 20000)
                    ->etc()
            )
        );
    }

    public function test_api_product_store_send_a_error(): void
    {
        $product = [
            'name' => 'Product 2'
        ];

        $response = $this->actingAs($this->admin)->postJson('/api/products', $product);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('price');
    }
}

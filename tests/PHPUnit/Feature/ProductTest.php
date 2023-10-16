<?php

namespace Tests\PHPUnit\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithUserAndAdmin;

class ProductTest extends TestCase
{

    use RefreshDatabase;
    use WithUserAndAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createUserAndAdmin();

    }

    /**
     * A basic feature test example.
     */
    public function test_application_has_a_products_page(): void
    {
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertOk();

        $response->assertSee(__('Products'));

    }

    public function test_products_page_has_a_table_with_name_and_price(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertSee('table id="products"', escape: false);
        $response->assertSeeText('Name');
        $response->assertSeeText('Price');

        $response->assertOk();
    }

    public function test_products_page_table_is_empty(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertSee(__('No products found'));
    }

    public function test_products_page_contains_non_empty_table(): void
    {

        $product = Product::create([
            'name' => 'Product 1',
            'price' => '1500'
        ]);

        $response = $this->actingAs($this->user)->get('/products');
        $response->assertStatus(200);

        $response->assertSeeText('Product 1');
        $response->assertSeeText('1500');
        $response->assertDontSee(__('No products found'));
        $response->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product) ;
        });

    }

    public function test_paginated_products_table_doesnt_contain_11th_record(): void
    {

        $products = Product::factory()->count(11)->create();
        $lastProduct = $products->last();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($collection) use ($lastProduct) {
            return !$collection->contains($lastProduct);
        });
    }

    public function test_admin_can_see_products_create_button(): void
    {
        $response = $this->actingAs($this->admin)->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Add new product');
    }

    public function test_non_admin_user_cannot_see_products_create_button(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee('Add new product');
    }

    public function test_admin_can_access_products_create_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_non_admin_user_cannot_access_products_create_page(): void
    {
        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_create_product_successfully(): void
    {

        $product = [
            'name' => 'Product 123',
            'price' => '12345'
        ];
        $response = $this->actingAs($this->admin)->post('/products', $product);

        $response->assertStatus(302);
        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', $product);

        $lastProduct = Product::latest()->first();
        $this->assertEquals($product['name'], $lastProduct->name);
        $this->assertEquals($product['price'], $lastProduct->price);
    }

    public function test_create_product_with_a_description(): void
    {
        $product = [
            'name' => 'Product 123',
            'price' => '12345',
            'description' => 'What an amazing product'
        ];
        $response = $this->actingAs($this->admin)->post('/products', $product);

        $response->assertStatus(302);
        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', $product);

        $lastProduct = Product::latest()->first();
        $this->assertEquals($product['name'], $lastProduct->name);
        $this->assertEquals($product['price'], $lastProduct->price);
        $this->assertEquals($product['description'], $lastProduct->description);
    }

    public function test_admin_can_see_edit_products_page(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->get('/products/' . $product->id . '/edit' );

        $response->assertStatus(200);
        $response->assertSee('value="' . $product->name . '"', false);
        $response->assertSee('value="' . $product->price . '"', false);
    }

    public function test_product_update_validation_redirects_back_to_form(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->put('/products/' . $product->id, [
            'name' => '',
            'price' => ''
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['price']);
        $response->assertInvalid(['name', 'price']);

    }

    public function test_product_delete_successfully(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->delete('/products/' . $product->id);

        $response->assertStatus(302);
        $response->assertRedirect('products');

        $this->assertDatabaseMissing('products', $product->toArray());
        $this->assertDatabaseCount('products', 0);
    }



}

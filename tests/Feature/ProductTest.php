<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_application_has_a_products_page(): void
    {
        $response = $this->get('/products');
        $response->assertOk();

        $response->assertSee(__('Products'));

    }

    public function test_products_page_has_a_table_with_name_and_price(): void
    {
        $response = $this->get('/products');

        $response->assertSee('table id="products"', escape: false);
        $response->assertSeeText('Name');
        $response->assertSeeText('Price');

        $response->assertOk();
    }

    public function test_products_page_table_is_empty(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee(__('No products found'));
    }

    public function test_products_page_contains_non_empty_table(): void
    {

        Product::create([
            'name' => 'Product 1',
            'price' => '1500'
        ]);
        $response = $this->get('/products');
        $response->assertStatus(200);

        $response->assertSee('Product 1');
        $response->assertSee('1500');
        $response->assertDontSee(__('No products found'));

    }

}

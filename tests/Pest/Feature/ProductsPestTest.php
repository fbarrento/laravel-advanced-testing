<?php


use App\Models\Product;

beforeEach(function() {
    $this->user = createUser();
    $this->admin = createUser(true);
});

test('homepage contains empty table', function () {
    $this->actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertSee(__('No products found'));
});

test('products page contains non empty table', function () {
    $product = Product::create([
        'name' => 'Product 1',
        'price' => '1500'
    ]);

    $this->actingAs($this->user)->get('/products')
        ->assertStatus(200)
        ->assertSeeText('Product 1')
        ->assertSeeText('1500')
        ->assertDontSee(__('No products found'))
        ->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product) ;
        });
});

test('create product successfully', function () {
    $product = [
        'name' => 'Product 123',
        'price' => 12345
    ];

    $this->actingAs($this->admin)->post('/products', $product)
        ->assertStatus(302)
        ->assertRedirect('/products');

    $this->assertDatabaseHas('products', $product);

    $lastProduct = Product::latest()->first();
    expect($lastProduct->name)->toBe($product['name']);
    expect($lastProduct->price)->toBe($product['price']);

});

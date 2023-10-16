<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function createProduct(array $attributes): Product
    {
        return DB::transaction(function () use ($attributes) {
            return Product::create([
                'name' => $attributes['name'],
                'price' => $attributes['price'],
                'description' => $attributes['description']
            ]);
        });
    }

}

<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{

    public function __invoke(): View
    {
        $products = Product::all();

        return view('products.index', [
            'products' => $products
        ]);

    }


}

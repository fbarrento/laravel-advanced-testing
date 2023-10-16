<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditController extends Controller
{


    public function __invoke(Request $request, Product $product): View
    {
        return view('products.edit')->with([
            'product' => $product
        ]);
    }


}

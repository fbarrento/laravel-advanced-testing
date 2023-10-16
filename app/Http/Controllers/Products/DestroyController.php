<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DestroyController extends Controller
{
    public function __invoke(Request $request, Product $product): RedirectResponse
    {
        $product->delete();
        return Redirect::route('products')->with('status', 'product-deleted');
    }
}

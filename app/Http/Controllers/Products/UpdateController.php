<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UpdateController extends Controller
{

    public function __invoke(UpdateProductRequest $request, Product $product): RedirectResponse
    {

        $product->update($request->only(['name', 'price']));

        return Redirect::route('products.edit', ['product' => $product->id])
            ->with('status', 'product-updated');
    }

}

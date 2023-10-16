<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    public ProductService $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function __invoke(StoreProductRequest $request): RedirectResponse
    {

        $this->productService->createProduct($request->validated());

        return redirect()->route('products');
    }
}

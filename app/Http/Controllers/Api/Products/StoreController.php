<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{


    public ProductService $productService;

    public function __construct(ProductService $productService )
    {
        $this->productService = $productService;
    }

    public function __invoke(StoreProductRequest $request): ProductResource
    {

        $product = $this->productService->createProduct(
            $request->validated()
        );

        return (new ProductResource($product));

    }

}

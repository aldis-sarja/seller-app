<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class CreateProductService extends ProductService
{
    public function execute(ProductRequest $request): Product
    {
        return $this->productRepository->createProduct($request);
    }
}

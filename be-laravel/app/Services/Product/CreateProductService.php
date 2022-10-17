<?php

namespace App\Services\Product;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class CreateProductService extends ProductService
{
    public function execute(StoreProductRequest $request): Product
    {
        return $this->productRepository->createProduct($request);
    }
}

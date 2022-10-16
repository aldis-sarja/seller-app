<?php

namespace App\Services\Product;

use App\Http\Requests\StoreProductRequest;

class CreateProductService extends ProductService
{
    public function execute(StoreProductRequest $request)
    {
        return $this->productRepository->createProduct(
            $request->get('name'),
            $request->get('type'),
            $request->get('description')
        );
    }
}

<?php

namespace App\Services\Product;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class UpdateProductService extends ProductService
{
    public function execute(int $id, UpdateProductRequest $request): Product
    {
        return $this->productRepository->updateProduct(
            $id,
            $request->get('name'),
            $request->get('type'),
            $request->get('description')
        );
    }
}

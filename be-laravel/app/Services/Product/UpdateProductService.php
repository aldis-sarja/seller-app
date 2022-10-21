<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class UpdateProductService extends ProductService
{
    public function execute(int $id, ProductRequest $request): Product
    {
        return $this->productRepository->updateProduct($id, $request);
    }
}

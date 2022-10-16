<?php

namespace App\Services\Product;

use App\Models\Product;

class GetProductByIdService extends ProductService
{
    public function execute(int $id): Product
    {
        return $this->productRepository->getProductById($id);
    }
}

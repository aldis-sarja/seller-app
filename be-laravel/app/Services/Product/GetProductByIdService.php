<?php

namespace App\Services\Product;

class GetProductByIdService extends ProductService
{
    public function execute(int $id)
    {
        return $this->productRepository->getProductById($id);
    }
}

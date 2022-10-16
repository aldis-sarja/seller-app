<?php

namespace App\Services\Product;

class DeleteProductService extends ProductService
{
    public function execute(int $id): bool
    {
        return $this->productRepository->deleteProduct($id);
    }
}

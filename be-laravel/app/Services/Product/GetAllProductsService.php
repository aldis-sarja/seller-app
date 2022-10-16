<?php

namespace App\Services\Product;

class GetAllProductsService extends ProductService
{
    public function execute()
    {
        return $this->productRepository->getAllProducts();
    }
}

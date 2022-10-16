<?php

namespace App\Services\Product;

use Illuminate\Database\Eloquent\Collection;

class GetAllProductsService extends ProductService
{
    public function execute(): Collection
    {
        return $this->productRepository->getAllProducts();
    }
}

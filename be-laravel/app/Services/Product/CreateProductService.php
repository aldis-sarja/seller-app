<?php

namespace App\Services\Product;

use App\Models\Product;

class CreateProductService extends ProductService
{
    public function execute(ProductData $productData): Product
    {
        return $this->productRepository->createProduct(
            new \App\Models\ProductData(
                $productData->getName(),
                $productData->getType(),
                $productData->getDescription()
            )
        );
    }
}

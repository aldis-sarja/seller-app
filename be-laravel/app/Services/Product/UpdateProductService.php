<?php

namespace App\Services\Product;

use App\Models\Product;

class UpdateProductService extends ProductService
{
    public function execute(ProductData $productData): Product
    {
        return $this->productRepository->updateProduct(
            new \App\Models\ProductData(
                $productData->getName(),
                $productData->getType(),
                $productData->getDescription(),
                $productData->getId()
            )
        );
    }
}

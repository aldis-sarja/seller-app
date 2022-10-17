<?php

namespace App\Services\Product;

use App\Repositories\ProductRepositoryInterface;

abstract class ProductService
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
}

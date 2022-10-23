<?php

namespace App\Repositories;

use App\Models\ProductData;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(ProductData $productData);
    public function updateProduct(ProductData $productData);
    public function deleteProduct(int $id);
}

<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(ProductRequest $request);
    public function updateProduct(int $id, ProductRequest $request);
    public function deleteProduct(int $id);
}

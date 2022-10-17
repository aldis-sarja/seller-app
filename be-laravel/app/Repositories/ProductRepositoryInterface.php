<?php

namespace App\Repositories;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(StoreProductRequest $request);
    public function updateProduct(int $id, UpdateProductRequest $request);
    public function deleteProduct(int $id);
}

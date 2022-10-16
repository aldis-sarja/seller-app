<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(string $name, string $type, string $description);
    public function updateProduct(int $id, string $name, string $type, string $description);
    public function deleteProduct(int $id);
}

<?php

namespace App\Repositories;

use App\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts(): Collection
    {
        return Product::all();
    }

    public function getProductById($id): Product
    {
        return Product::with('service.client')->findOrFail($id);
    }

    public function createProduct(string $name, string $type, string $description): Product
    {
        return Product::create([
            'name' => $name,
            'type' => $type,
            'description' => $description
        ]);
    }

    public function updateProduct(int $id, string $name, string $type, string $description): Product
    {
        $product = Product::with('service.client')->findOrFail($id);
        $product->update([
            'name' => $name,
            'type' => $type,
            'description' => $description,
        ]);
        return $product;
    }

    public function deleteProduct(int $id): bool
    {
        return Product::destroy($id) > 0;
    }
}

<?php

namespace App\Repositories;

use App\Repositories\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::with('service.client')->findOrFail($id);
//        return Product::findOrFail($id);
    }

    public function createProduct(string $name, string $type, string $description)
    {
        return Product::create([
            'name' => $name,
            'type' => $type,
            'description' => $description
        ]);
    }

    public function updateProduct(int $id, string $name, string $type, string $description)
    {
        $product = Product::with('service.client')->findOrFail($id);
//        $product = Product::findOrFail($id);
        $product->update([
            'name' => $name,
            'type' => $type,
            'description' => $description,
        ]);
//        $product->name = $name;
//        $product->type = $type;
//        $product->description = $description;
//        $product->save();
        return $product;
    }

    public function deleteProduct(int $id)
    {
        Product::destroy($id);
    }
}

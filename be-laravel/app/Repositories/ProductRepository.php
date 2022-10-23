<?php

namespace App\Repositories;

use App\Models\ProductData;
use App\Models\Service;
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

    public function createProduct(ProductData $productData): Product
    {
        return Product::create([
            'name' => $productData->getName(),
            'type' => $productData->getType(),
            'description' => $productData->getDescription()
        ]);
    }

    public function updateProduct(ProductData $productData): Product
    {
        $product = Product::with('service.client')->findOrFail($productData->getId());
        $product->update([
            'name' => $productData->getName(),
            'type' => $productData->getType(),
            'description' => $productData->getDescription()
        ]);
        return $product;
    }

    public function deleteProduct(int $id): bool
    {
        Service::where([
            ['product_id', '=', $id]
        ])->delete();

        return Product::destroy($id) > 0;
    }
}

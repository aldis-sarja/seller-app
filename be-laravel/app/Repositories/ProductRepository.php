<?php

namespace App\Repositories;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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

    public function createProduct(StoreProductRequest $request): Product
    {
        return Product::create([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'description' => $request->get('description')
        ]);
    }

    public function updateProduct(int $id, UpdateProductRequest $request): Product
    {
        $product = Product::with('service.client')->findOrFail($id);
        $product->update([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'description' => $request->get('description')
        ]);
        return $product;
    }

    public function deleteProduct(int $id): bool
    {
        return Product::destroy($id) > 0;
    }
}

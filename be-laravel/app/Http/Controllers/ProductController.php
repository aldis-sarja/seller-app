<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\GetAllProductsService;
use App\Services\Product\GetProductByIdService;
use App\Services\Product\UpdateProductService;

class ProductController extends Controller
{
    private GetAllProductsService $getAllProductsService;
    private GetProductByIdService $getProductByIdService;
    private CreateProductService $createProductService;
    private DeleteProductService $deleteProductService;
    private UpdateProductService $updateProductService;

    public function __construct(
        GetAllProductsService $getAllProductsService,
        GetProductByIdService $getProductByIdService,
        CreateProductService   $createProductService,
        UpdateProductService   $updateProductService,
        DeleteProductService   $deleteProductService
    )
    {
        $this->getAllProductsService = $getAllProductsService;
        $this->getProductByIdService = $getProductByIdService;
        $this->createProductService = $createProductService;
        $this->deleteProductService = $deleteProductService;
        $this->updateProductService = $updateProductService;
    }

    public function index()
    {
        try {
            $data = $this->getAllProductsService->execute();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $request->validated();

        try {
            $data = $this->createProductService->execute($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Can\'t create! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function show(int $id)
    {
        try {
            $data = $this->getProductByIdService->execute($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(int $id, UpdateProductRequest $request)
    {
        $request->validated();

        try {
            $data = $this->updateProductService->execute($id, $request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(int $id)
    {
        if (!$this->deleteProductService->execute($id)) {
            return response()->json(['message' => 'Not found! '], 404);
        }
    }
}

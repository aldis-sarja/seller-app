<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\GetAllProductsService;
use App\Services\Product\GetProductByIdService;
use App\Services\Product\ProductData;
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

    public function store(ProductRequest $request)
    {

        try {
            $data = $this->createProductService->execute(
                new ProductData(
                    $request->get('name'),
                    $request->get('type'),
                    $request->get('description')
                )
            );
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

    public function update(int $id, ProductRequest $request)
    {
        try {
            $data = $this->updateProductService->execute(
                new ProductData(
                    $request->get('name'),
                    $request->get('type'),
                    $request->get('description'),
                    $id
                )
            );
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

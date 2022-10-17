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
use http\Env\Request;

class ProductController extends Controller
{
    private $getAllProductsService;
    private $getProductByIdService;
    private $createProductService;
    private $deleteProductService;
    private $updateProductService;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        $res = $this->deleteProductService->execute($id);
        if (!$res) {
            return response()->json(['message' => 'Not found! '], 404);
        }
    }
}

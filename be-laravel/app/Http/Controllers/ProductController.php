<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Product\CreateClientService;
use App\Services\Product\DeleteClientService;
use App\Services\Product\GetAllProductsService;
use App\Services\Product\GetProductByIdService;
use App\Services\Product\UpdateClientService;

class ProductController extends Controller
{
    /**
     * @var GetAllProductsService
     */
    private $getAllProductsService;
    /**
     * @var GetProductByIdService
     */
    private $getProductByIdService;
    /**
     * @var CreateClientService
     */
    private $createProductService;
    /**
     * @var DeleteClientService
     */
    private $deleteProductService;
    /**
     * @var UpdateClientService
     */
    private $updateProductService;

    public function __construct(
        GetAllProductsService $getAllProductsService,
        GetProductByIdService $getProductByIdService,
        CreateClientService   $createProductService,
        UpdateClientService   $updateProductService,
        DeleteClientService   $deleteProductService
    )
    {
        $this->getAllProductsService = $getAllProductsService;
        $this->getProductByIdService = $getProductByIdService;
        $this->createProductService = $createProductService;
        $this->deleteProductService = $deleteProductService;
        $this->updateProductService = $updateProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $data = $this->createProductService->execute($validatedData);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Can\'t create! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) //show(Product $product)
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

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, UpdateProductRequest $request)
    {
        try {
            $res = $this->updateProductService->execute($id, $request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $res = $this->deleteProductService->execute($id);
    }
}

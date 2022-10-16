<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\GetAllProductsService;
use App\Services\Product\GetProductByIdService;

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
     * @var CreateProductService
     */
    private $createProductService;

    public function __construct(
        GetAllProductsService $getAllProductsService,
        GetProductByIdService $getProductByIdService,
        CreateProductService  $createProductService
    )
    {
        $this->getAllProductsService = $getAllProductsService;
        $this->getProductByIdService = $getProductByIdService;
        $this->createProductService = $createProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => $this->getAllProductsService->execute()
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
        return response()->json([
            'data' => $this->createProductService->execute($validatedData)
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
        return response()->json([
            'data' => $this->getProductByIdService->execute($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

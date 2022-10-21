<?php

namespace App\Repositories;

use App\Http\Requests\ServiceRequest;
use App\Models\Product;
use App\Repositories\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAllServices(): Collection
    {
        return Service::with(['client', 'product'])->get();
    }

    public function getServiceById($id): Service
    {
        return Service::with(['client', 'product'])->findOrFail($id);
    }

    public function createService(ServiceRequest $request): Service
    {
        $product = Product::findOrFail($request->get('product_id'));
        if ($product->reserved)
        {
            throw new ModelNotFoundException('This product is already reserved!');
        }

        $product->reserved = $request->get('date');
        $product->update();

        return Service::create([
            'client_id' => $request->get('client_id'),
            'product_id' => $request->get('product_id'),
            'price' => $request->get('price') * 100,
            'date' => $request->get('date'),
        ]);
    }

    public function updateService(int $id, ServiceRequest $request): Service
    {
        $service = Service::with(['client', 'product'])->findOrFail($id);
        $service->update([
            'client_id' => $request->get('client_id'),
            'product_id' => $request->get('product_id'),
            'price' => $request->get('price') * 100,
            'date' => $request->get('date'),
        ]);
        return $service;
    }

    public function deleteService(int $id): bool
    {
        return Service::destroy($id) > 0;
    }
}

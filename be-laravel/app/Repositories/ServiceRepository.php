<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ServiceData;
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

    public function createService(ServiceData $serviceData): Service
    {
        $product = Product::findOrFail($serviceData->getProductId());
        if ($product->reserved)
        {
            throw new ModelNotFoundException('This product is already reserved!');
        }

        $product->reserved = $serviceData->getDate();
        $product->update();

        return Service::create([
            'client_id' => $serviceData->getClientId(),
            'product_id' => $serviceData->getProductId(),
            'price' => $serviceData->getPrice(),
            'date' => $serviceData->getDate()
        ]);
    }

    public function updateService(ServiceData $serviceData): Service
    {
        $service = Service::findOrFail($serviceData->getId());
        $service->update([
            'client_id' => $serviceData->getClientId(),
            'product_id' => $serviceData->getProductId(),
            'price' => $serviceData->getPrice(),
            'date' => $serviceData->getDate()
        ]);
        $service = Service::with(['client', 'product'])->findOrFail($serviceData->getId());
        return $service;
    }

    public function deleteService(int $id): bool
    {
        $service = Service::findOrFail($id);

        $product = Product::FindOrFail($service->product_id);
        $product->reserved = null;
        $product->update();

        return $service->delete() > 0;
    }
}

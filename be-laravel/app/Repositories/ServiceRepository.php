<?php

namespace App\Repositories;

use App\Repositories\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAllServices(): Collection
    {
        return Service::all();
    }

    public function getServiceById($id): Service
    {
        return Service::with(['client', 'product'])->findOrFail($id);
    }

    public function createService(int $client_id, int $product_id, int $price, Carbon $date): Service
    {
        return Service::create([
            'client_id' => $client_id,
            'product_id' => $product_id,
            'price' => $price * 100,
            'date' => $date,
        ]);
    }

    public function updateService(int $id, int $client_id, int $product_id, int $price, Carbon $date): Service
    {
        $service = Service::with(['client', 'product'])->findOrFail($id);
        $service->update([
            'client_id' => $client_id,
            'product_id' => $product_id,
            'price' => $price * 100,
            'date' => $date,
        ]);
        return $service;
    }

    public function deleteService(int $id): bool
    {
        return Service::destroy($id) > 0;
    }
}

<?php

namespace App\Repositories;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;


interface ServiceRepositoryInterface
{
    public function getAllServices(): Collection;
    public function getServiceById($id): Service;
    public function createService(StoreServiceRequest $request): Service;
    public function updateService(int $id, UpdateServiceRequest $request): Service;
    public function deleteService(int $id): bool;
}

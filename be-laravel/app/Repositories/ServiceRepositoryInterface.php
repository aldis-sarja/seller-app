<?php

namespace App\Repositories;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;


interface ServiceRepositoryInterface
{
    public function getAllServices(): Collection;
    public function getServiceById($id): Service;
    public function createService(ServiceRequest $request): Service;
    public function updateService(int $id, ServiceRequest $request): Service;
    public function deleteService(int $id): bool;
}

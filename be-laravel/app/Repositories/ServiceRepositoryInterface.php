<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\ServiceData;
use Illuminate\Database\Eloquent\Collection;


interface ServiceRepositoryInterface
{
    public function getAllServices(): Collection;
    public function getServiceById($id): Service;
    public function createService(ServiceData $serviceData): Service;
    public function updateService(ServiceData $serviceData): Service;
    public function deleteService(int $id): bool;
}

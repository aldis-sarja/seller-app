<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;


interface ServiceRepositoryInterface
{
    public function getAllServices(): Collection;
    public function getServiceById($id): Service;
    public function createService(int $client_id, int $product_id, int $price, Carbon $date): Service;
    public function updateService(int $id, int $client_id, int $product_id, int $price, Carbon $date): Service;
    public function deleteService(int $id): bool;
}

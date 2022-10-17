<?php

namespace App\Services\Service;

use Illuminate\Database\Eloquent\Collection;

class GetAllServicesService extends ServiceService
{
    public function execute(): Collection
    {
        return $this->serviceRepository->getAllServices();
    }
}

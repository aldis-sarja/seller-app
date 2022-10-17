<?php

namespace App\Services\Service;

use App\Models\Service;

class GetServiceByIdService extends ServiceService
{
    public function execute(int $id): Service
    {
        return $this->serviceRepository->getServiceById($id);
    }
}

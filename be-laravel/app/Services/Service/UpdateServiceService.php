<?php

namespace App\Services\Service;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;

class UpdateServiceService extends ServiceService
{
    public function execute(int $id, ServiceRequest $request): Service
    {
        return $this->serviceRepository->updateService($id, $request);
    }
}

<?php

namespace App\Services\Service;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;

class CreateServiceService extends ServiceService
{
    public function execute(ServiceRequest $request): Service
    {
        return $this->serviceRepository->createService($request);
    }
}

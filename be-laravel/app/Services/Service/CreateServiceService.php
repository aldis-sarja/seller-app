<?php

namespace App\Services\Service;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;

class CreateServiceService extends ServiceService
{
    public function execute(StoreServiceRequest $request): Service
    {
        return $this->serviceRepository->createService(
            $request->get('client_id'),
            $request->get('product_id'),
            $request->get('price'),
            $request->get('date')
        );
    }
}

<?php

namespace App\Services\Service;

use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;

class UpdateServiceService extends ServiceService
{
    public function execute(int $id, UpdateServiceRequest $request): Service
    {
        return $this->serviceRepository->updateService(
            $id,
            $request->get('client_id'),
            $request->get('product_id'),
            $request->get('price'),
            $request->get('date')
        );
    }
}

<?php

namespace App\Services\Service;

use App\Models\Service;

class CreateServiceService extends ServiceService
{
    public function execute(ServiceData $serviceData): Service
    {
        return $this->serviceRepository->createService(
            new \App\Models\ServiceData(
                $serviceData->getClientId(),
                $serviceData->getProductId(),
                $serviceData->getPrice(),
                $serviceData->getDate()
            )
        );
    }
}

<?php

namespace App\Services\Service;

use App\Models\Service;

class UpdateServiceService extends ServiceService
{
    public function execute(ServiceData $serviceData): Service
    {
        return $this->serviceRepository->updateService(
            new \App\Models\ServiceData(
                $serviceData->getClientId(),
                $serviceData->getProductId(),
                $serviceData->getPrice(),
                $serviceData->getDate(),
                $serviceData->getId()
            )
        );
    }
}

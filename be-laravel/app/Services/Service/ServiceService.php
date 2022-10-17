<?php

namespace App\Services\Service;

use App\Repositories\ServiceRepositoryInterface;

abstract class ServiceService
{
    protected ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
}

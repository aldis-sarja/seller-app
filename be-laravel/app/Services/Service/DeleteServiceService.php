<?php

namespace App\Services\Service;

class DeleteServiceService extends ServiceService
{
    public function execute(int $id): bool
    {
        return $this->serviceRepository->deleteService($id);
    }
}

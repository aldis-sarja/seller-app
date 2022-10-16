<?php

namespace App\Services\Client;

class GetAllService extends ClientService
{
    public function execute()
    {
        return $this->clientRepository->getAllClients();
    }
}

<?php

namespace App\Services\Client;

use App\Models\Client;

class CreateClientService extends ClientService
{
    public function execute(ClientData $clientData): Client
    {
        return $this->clientRepository->createClient(
            new \App\Models\ClientData(
                $clientData->getName(),
                $clientData->getAddress(),
                $clientData->getDescription()
            )
        );
    }
}

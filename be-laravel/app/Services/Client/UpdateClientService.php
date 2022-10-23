<?php

namespace App\Services\Client;

use App\Models\Client;

class UpdateClientService extends ClientService
{
    public function execute(ClientData $clientData): Client
    {
        return $this->clientRepository->updateClient(
            new \App\Models\ClientData(
                $clientData->getName(),
                $clientData->getAddress(),
                $clientData->getDescription(),
                $clientData->getId()
            )
        );
    }
}

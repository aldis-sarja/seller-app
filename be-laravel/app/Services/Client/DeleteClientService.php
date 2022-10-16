<?php

namespace App\Services\Client;

class DeleteClientService extends ClientService
{
    public function execute(int $id): bool
    {
        return $this->clientRepository->deleteClient($id);
    }
}

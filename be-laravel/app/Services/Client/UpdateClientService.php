<?php

namespace App\Services\Client;

use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class UpdateClientService extends ClientService
{
    public function execute(int $id, UpdateclientRequest $request): Client
    {
        return $this->clientRepository->updateClient($id, $request);
    }
}

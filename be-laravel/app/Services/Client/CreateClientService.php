<?php

namespace App\Services\Client;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\Client\ClientService;

class CreateClientService extends ClientService
{
    public function execute(ClientRequest $request): Client
    {
        return $this->clientRepository->createClient($request);
    }
}

<?php

namespace App\Services\Client;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Services\Client\ClientService;

class CreateClientService extends ClientService
{
    public function execute(StoreClientRequest $request): Client
    {
        return $this->clientRepository->createClient(
            $request->get('name'),
            $request->get('address'),
            $request->get('description')
        );
    }
}

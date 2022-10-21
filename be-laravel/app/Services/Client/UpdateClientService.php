<?php

namespace App\Services\Client;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

class UpdateClientService extends ClientService
{
    public function execute(int $id, ClientRequest $request): Client
    {
        return $this->clientRepository->updateClient($id, $request);
    }
}

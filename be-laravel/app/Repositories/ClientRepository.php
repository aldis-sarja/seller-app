<?php

namespace App\Repositories;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Repositories\ClientRepositoryInterface;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    public function getAllClients(): Collection
    {
        return Client::all();
    }

    public function getClientById($id): Client
    {
        return Client::with('service.product')->findOrFail($id);
    }

    public function createClient(StoreClientRequest $request): Client
    {
        return Client::create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'description' => $request->get('description')
        ]);
    }

    public function updateClient(int $id, UpdateclientRequest $request): Client
    {
        $client = Client::with('service.product')->findOrFail($id);
        $client->update([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'description' => $request->get('description')
        ]);

        return $client;
    }

    public function deleteClient(int $id): bool
    {
        return Client::destroy($id) > 0;
    }
}

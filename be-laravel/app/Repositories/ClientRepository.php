<?php

namespace App\Repositories;

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

    public function createClient(string $name, string $address, string $description): Client
    {
        return Client::create([
            'name' => $name,
            'address' => $address,
            'description' => $description
        ]);
    }

    public function updateClient(int $id, string $name, string $address, string $description): Client
    {
        $client = Client::with('service.product')->findOrFail($id);
        $client->update([
            'name' => $name,
            'address' => $address,
            'description' => $description
        ]);
//        $client->name = $name;
//        $client->address = $address;
//        $client->description = $description;
//        $client->save();
        return $client;
    }

    public function deleteClient(int $id): bool
    {
        return Client::destroy($id) > 0;
    }
}

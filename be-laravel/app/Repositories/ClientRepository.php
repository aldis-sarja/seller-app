<?php

namespace App\Repositories;

use App\Repositories\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function getAllClients()
    {
        return Client::all();
//        return Client::with('service.product')->get();
    }

    public function getClientById($id)
    {
        return Client::findOrFail($id)->with('service.product');
    }

    public function createClient(string $name, string $address, string $description)
    {
        return Client::create([
            'name' => $name,
            'address' => $address,
            'description' => $description
        ]);
    }

    public function updateClient(int $id, string $name, string $address, string $description)
    {
        $client = Client::findOrFail($id)->with('service.product');
        $client->name = $name;
        $client->address = $address;
        $client->description = $description;
        $client->save();
        return $client;
    }

    public function deleteClient(int $id)
    {
        Client::destroy($id);
    }
}

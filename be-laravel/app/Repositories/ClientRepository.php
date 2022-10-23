<?php

namespace App\Repositories;

use App\Models\ClientData;
use App\Models\Product;
use App\Models\Service;
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

    public function createClient(ClientData $clientData): Client
    {
        return Client::create([
            'name' => $clientData->getName(),
            'address' => $clientData->getAddress(),
            'description' => $clientData->getDescription()
        ]);
    }

    public function updateClient(ClientData $clientData): Client
    {
        $client = Client::with('service.product')->findOrFail($clientData->getId());
        $client->update([
            'name' => $clientData->getName(),
            'address' => $clientData->getAddress(),
            'description' => $clientData->getDescription()
        ]);

        return $client;
    }

    public function deleteClient(int $id): bool
    {
        $services = Service::where([
            ['client_id', '=', $id]
        ]);

        foreach ($services->get() as $service) {
            $product = Product::findOrFail($service->product_id);
            $product->reserved = null;
            $product->update();
        }
        $services->delete();

        return Client::destroy($id) > 0;
    }
}

<?php

namespace App\Repositories;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
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

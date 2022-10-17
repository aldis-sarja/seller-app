<?php

namespace App\Repositories;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

interface ClientRepositoryInterface
{
    public function getAllClients();
    public function getClientById($id);
    public function createClient(StoreClientRequest $request);
    public function updateClient(int $id, UpdateclientRequest $request);
    public function deleteClient(int $id);
}

<?php

namespace App\Repositories;

use App\Http\Requests\ClientRequest;

interface ClientRepositoryInterface
{
    public function getAllClients();
    public function getClientById($id);
    public function createClient(ClientRequest $request);
    public function updateClient(int $id, ClientRequest $request);
    public function deleteClient(int $id);
}

<?php

namespace App\Repositories;

use App\Models\ClientData;

interface ClientRepositoryInterface
{
    public function getAllClients();
    public function getClientById($id);
    public function createClient(ClientData $clientData);
    public function updateClient(ClientData $clientData);
    public function deleteClient(int $id);
}

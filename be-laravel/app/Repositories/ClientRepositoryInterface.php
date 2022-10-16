<?php

namespace App\Repositories;

interface ClientRepositoryInterface
{
    public function getAllClients();
    public function getClientById($id);
    public function createClient(string $name, string $address, string $description);
    public function updateClient(int $id, string $name, string $address, string $description);
    public function deleteClient(int $id);
}

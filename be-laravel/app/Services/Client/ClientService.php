<?php

namespace App\Services\Client;

use App\Repositories\ClientRepositoryInterface;

abstract class ClientService
{
    /**
     * @var ClientRepositoryInterface
     */
    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
}

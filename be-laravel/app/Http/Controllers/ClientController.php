<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Services\Client\CreateClientService;
use App\Services\Client\DeleteClientService;
use App\Services\Client\GetAllClientsService;
use App\Services\Client\GetClientByIdService;
use App\Services\Client\UpdateClientService;

class ClientController extends Controller
{
    private GetAllClientsService $getAllClientsService;
    private GetClientByIdService $getClientByIdService;
    private CreateClientService $createClientService;
    private UpdateClientService $updateClientService;
    private DeleteClientService $deleteClientService;

    public function __construct(
        GetAllClientsService $getAllClientsService,
        GetClientByIdService $getClientByIdService,
        CreateClientService $createClientService,
        UpdateClientService $updateClientService,
        DeleteClientService $deleteClientService
    )
    {
        $this->getAllClientsService = $getAllClientsService;
        $this->getClientByIdService = $getClientByIdService;
        $this->createClientService = $createClientService;
        $this->updateClientService = $updateClientService;
        $this->deleteClientService = $deleteClientService;
    }

    public function index()
    {
        try {
            $data = $this->getAllClientsService->execute();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }
        return response()->json([
            'data' => $data
        ]);
    }

    public function store(StoreClientRequest $request)
    {
        $request->validated();

        try {
            $data = $this->createClientService->execute($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Can\'t create! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function show(int $id)
    {
        try {
            $data = $this->getClientByIdService->execute($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(int $id, UpdateClientRequest $request)
    {
        try {
            $data = $this->updateClientService->execute($id, $request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(int $id)
    {
        if (!$this->deleteClientService->execute($id)) {
            return response()->json(['message' => 'Not found! '], 404);
        }
    }
}

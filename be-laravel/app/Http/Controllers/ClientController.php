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
    /**
     * @var GetAllClientsService
     */
    private $getAllClientsService;
    /**
     * @var GetClientByIdService
     */
    private $getClientByIdService;
    /**
     * @var CreateClientService
     */
    private $createClientService;
    /**
     * @var UpdateClientService
     */
    private $updateClientService;
    /**
     * @var DeleteClientService
     */
    private $deleteClientService;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $data = $this->createClientService->execute($validatedData);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Can\'t create! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, UpdateClientRequest $request)
    {
        try {
            $res = $this->updateClientService->execute($id, $request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $res = $this->deleteClientService->execute($id);
        if (!$res) {
            return response()->json(['message' => 'Not found! '], 404);
        }
        return response();
    }
}

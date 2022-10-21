<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\ServiceRequest;
use App\Services\Service\CreateServiceService;
use App\Services\Service\DeleteServiceService;
use App\Services\Service\GetAllServicesService;
use App\Services\Service\GetServiceByIdService;
use App\Services\Service\UpdateServiceService;

class ServiceController extends Controller
{
    private GetAllServicesService $getAllServicesService;
    private GetServiceByIdService $getServiceByIdService;
    private CreateServiceService $createServiceService;
    private UpdateServiceService $updateServiceService;
    private DeleteServiceService $deleteServiceService;

    public function __construct(
        GetAllServicesService $getAllServicesService,
        GetServiceByIdService $getServiceByIdService,
        CreateServiceService $createServiceService,
        UpdateServiceService $updateServiceService,
        DeleteServiceService $deleteServiceService

    )
    {
        $this->getAllServicesService = $getAllServicesService;
        $this->getServiceByIdService = $getServiceByIdService;
        $this->createServiceService = $createServiceService;
        $this->updateServiceService = $updateServiceService;
        $this->deleteServiceService = $deleteServiceService;
    }

    public function index()
    {
        try {
            $data = $this->getAllServicesService->execute();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }
        return response()->json([
            'data' => $data
        ]);
    }

    public function store(ServiceRequest $request)
    {
        try {
            $data = $this->createServiceService->execute($request);
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
            $data = $this->getServiceByIdService->execute($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(int $id, ServiceRequest $request)
    {
        try {
            $data = $this->updateServiceService->execute($id, $request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found! ' . $e->getMessage()], 404);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(int $id)
    {
        if (!$this->deleteServiceService->execute($id)) {
            return response()->json(['message' => 'Not found! '], 404);
        }
    }
}

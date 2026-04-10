<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceStoreRequest;
use App\Http\Requests\MaintenanceUpdateRequest;
use App\Http\Resources\MaintenanceCollection;
use App\Http\Resources\MaintenanceResource;
use App\Models\Maintenance;
use Illuminate\Http\JsonResponse;

class MaintenanceApiController extends Controller
{
    public function index(): JsonResponse
    {
        $maintenances = Maintenance::with(['machine', 'technician'])
            ->orderBy('maintenance_date', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Data maintenance berhasil diambil',
            'data'    => new MaintenanceCollection($maintenances),
        ]);
    }

    public function store(MaintenanceStoreRequest $request): JsonResponse
    {
        $maintenance = Maintenance::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Maintenance berhasil ditambahkan',
            'data'    => new MaintenanceResource($maintenance->load(['machine', 'technician'])),
        ], 201);
    }

    public function show(Maintenance $maintenance): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new MaintenanceResource($maintenance->load(['machine', 'technician'])),
        ]);
    }

    public function update(MaintenanceUpdateRequest $request, Maintenance $maintenance): JsonResponse
    {
        $maintenance->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Maintenance berhasil diupdate',
            'data'    => new MaintenanceResource($maintenance->fresh(['machine', 'technician'])),
        ]);
    }

    public function destroy(Maintenance $maintenance): JsonResponse
    {
        $maintenance->delete();

        return response()->json([
            'success' => true,
            'message' => 'Maintenance berhasil dihapus',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends Controller
{
    // 🔹 GET /api/machines
    public function index(Request $request)
    {
        $query = Machine::with('location');

        // filter status (optional)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $machines = $query->latest('created_at')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List data machine',
            'data' => $machines
        ]);
    }

    // 🔹 POST /api/machines
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'              => 'nullable|string|max:50|unique:machines,code',
            'name'              => 'nullable|string|max:100',
            'brand'             => 'nullable|string|max:100',
            'type'              => 'nullable|string|max:100',
            'serial_number'     => 'nullable|string|max:100',
            'purchase_date'     => 'nullable|date',
            'installation_date' => 'nullable|date',
            'lifetime_hours'    => 'nullable|integer',
            'status'            => 'nullable|in:aktif,maintenance,rusak',
            'location_id'       => 'required|exists:locations,id',
        ]);

        $machine = Machine::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Machine berhasil dibuat',
            'data' => $machine
        ], 201);
    }

    // 🔹 GET /api/machines/{id}
    public function show($id)
    {
        $machine = Machine::with('location')->find($id);

        if (!$machine) {
            return response()->json([
                'success' => false,
                'message' => 'Machine tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $machine
        ]);
    }

    // 🔹 PUT /api/machines/{id}
    public function update(Request $request, $id)
    {
        $machine = Machine::find($id);

        if (!$machine) {
            return response()->json([
                'success' => false,
                'message' => 'Machine tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'code'              => 'nullable|string|max:50|unique:machines,code,' . $id,
            'name'              => 'nullable|string|max:100',
            'brand'             => 'nullable|string|max:100',
            'type'              => 'nullable|string|max:100',
            'serial_number'     => 'nullable|string|max:100',
            'purchase_date'     => 'nullable|date',
            'installation_date' => 'nullable|date',
            'lifetime_hours'    => 'nullable|integer',
            'status'            => 'nullable|in:aktif,maintenance,rusak',
            'location_id'       => 'required|exists:locations,id',
        ]);

        $machine->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Machine berhasil diupdate',
            'data' => $machine
        ]);
    }

    // 🔹 DELETE /api/machines/{id}
    public function destroy($id)
    {
        $machine = Machine::find($id);

        if (!$machine) {
            return response()->json([
                'success' => false,
                'message' => 'Machine tidak ditemukan'
            ], 404);
        }

        $machine->delete();

        return response()->json([
            'success' => true,
            'message' => 'Machine berhasil dihapus'
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MachineUsage;

class MachineUsageApiController extends Controller
{
    // 🔹 GET: list data
    public function index()
    {
        $data = MachineUsage::with('machine')
            ->orderBy('usage_date', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List data machine usage',
            'data' => $data
        ]);
    }

    // 🔹 POST: simpan data
    public function store(Request $request)
    {
        $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'usage_date' => 'required|date',
            'hours_used' => 'required|numeric|min:0',
        ]);

        // hitung total
        $lastTotal = MachineUsage::where('machine_id', $request->machine_id)
            ->latest('usage_date')
            ->value('total_hours') ?? 0;

        $total = $lastTotal + $request->hours_used;

        $data = MachineUsage::create([
            'machine_id' => $request->machine_id,
            'usage_date' => $request->usage_date,
            'hours_used' => $request->hours_used,
            'total_hours'=> $total,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    // 🔹 GET: detail
    public function show($id)
    {
        $data = MachineUsage::with('machine')->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // 🔹 PUT: update
    public function update(Request $request, $id)
    {
        $data = MachineUsage::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'usage_date' => 'required|date',
            'hours_used' => 'required|numeric|min:0',
        ]);

        $data->update([
            'machine_id' => $request->machine_id,
            'usage_date' => $request->usage_date,
            'hours_used' => $request->hours_used,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $data
        ]);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $data = MachineUsage::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Machine;
use App\Models\User;

class MaintenanceController extends Controller
{
    // 🔹 Tampilkan semua maintenance
    public function index()
    {
        $title = 'Data Maintenance';

        $maintenances = Maintenance::with(['machine', 'technician'])
            ->orderBy('maintenance_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.maintenance.index', compact('maintenances', 'title'));
    }

    // 🔹 Form tambah maintenance
    public function create()
    {
        $title = 'Tambah Maintenance';

        // Ambil data mesin untuk dropdown
        $machines = Machine::orderBy('name')->get();

        // Ambil data teknisi (user) untuk dropdown
        // Sesuaikan filter role jika kamu punya kolom role di tabel users
        $technicians = User::orderBy('name')->get();

        return view('admin.maintenance.create', compact('title', 'machines', 'technicians'));
    }

    // 🔹 Simpan maintenance baru
    public function store(Request $request)
    {
        $request->validate([
            'machine_id'       => 'required|exists:machines,id',
            'technician_id'    => 'nullable|exists:users,id',
            'maintenance_type' => 'required|in:preventive,corrective',
            'description'      => 'nullable|string|max:500',
            'maintenance_date' => 'required|date',
            'cost'             => 'nullable|numeric|min:0',
            'notes'            => 'nullable|string|max:1000',
        ]);

        Maintenance::create([
            'machine_id'       => $request->machine_id,
            'technician_id'    => $request->technician_id,
            'maintenance_type' => $request->maintenance_type,
            'description'      => $request->description,
            'maintenance_date' => $request->maintenance_date,
            'cost'             => $request->cost,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance berhasil ditambahkan');
    }

    // 🔹 Detail maintenance
    public function show($id)
    {
        $title = 'Detail Maintenance';

        $maintenance = Maintenance::with(['machine', 'technician'])->findOrFail($id);

        return view('admin.maintenance.show', compact('maintenance', 'title'));
    }

    // 🔹 Form edit maintenance
    public function edit($id)
    {
        $title = 'Edit Maintenance';

        $maintenance = Maintenance::findOrFail($id);

        // Ambil data mesin dan teknisi
        $machines = Machine::orderBy('name')->get();
        $technicians = User::orderBy('name')->get();

        return view('admin.maintenance.edit', compact('maintenance', 'title', 'machines', 'technicians'));
    }

    // 🔹 Update maintenance
    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $request->validate([
            'machine_id'       => 'required|exists:machines,id',
            'technician_id'    => 'nullable|exists:users,id',
            'maintenance_type' => 'required|in:preventive,corrective',
            'description'      => 'nullable|string|max:500',
            'maintenance_date' => 'required|date',
            'cost'             => 'nullable|numeric|min:0',
            'notes'            => 'nullable|string|max:1000',
        ]);

        $maintenance->update([
            'machine_id'       => $request->machine_id,
            'technician_id'    => $request->technician_id,
            'maintenance_type' => $request->maintenance_type,
            'description'      => $request->description,
            'maintenance_date' => $request->maintenance_date,
            'cost'             => $request->cost,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance berhasil diupdate');
    }

    // 🔹 Hapus maintenance
    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance berhasil dihapus');
    }


    // 🔹 API: Detail maintenance
    public function apiShow($id)
    {
        $maintenance = Maintenance::with(['machine', 'technician'])->find($id);

        if (!$maintenance) {
            return response()->json([
                'success' => false,
                'message' => 'Maintenance not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $maintenance
        ]);
    }
}

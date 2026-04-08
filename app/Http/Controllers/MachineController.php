<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Location;

class MachineController extends Controller
{
    // 🔹 Tampilkan semua mesin
    public function index()
    {
        $title = 'Data Machines';

        $machines = Machine::with('location')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.machine.index', compact('machines', 'title'));
    }

    // 🔹 Form tambah mesin
    public function create()
    {
        $title = 'Tambah Machine';
        $locations = Location::all();

        return view('admin.machine.create', compact('title', 'locations'));
    }

    // 🔹 Simpan mesin baru
    public function store(Request $request)
    {
        $request->validate([
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

        Machine::create([
            'code'              => $request->code,
            'name'              => $request->name,
            'brand'             => $request->brand,
            'type'              => $request->type,
            'serial_number'     => $request->serial_number,
            'purchase_date'     => $request->purchase_date,
            'installation_date' => $request->installation_date,
            'lifetime_hours'    => $request->lifetime_hours,
            'status'            => $request->status ?? 'aktif',
            'location_id'       => $request->location_id,
        ]);

        return redirect()->route('machine.index')
            ->with('success', 'Machine berhasil ditambahkan');
    }

    // 🔹 Detail mesin
    public function show($id)
    {
        $title = 'Detail Machine';

        $machine = Machine::with('location')->findOrFail($id);

        return view('admin.machine.show', compact('machine', 'title'));
    }

    // 🔹 Form edit mesin
    public function edit($id)
    {
        $title = 'Edit Machine';

        $machine = Machine::findOrFail($id);
        $locations = Location::all();

        return view('admin.machine.edit', compact('machine', 'title', 'locations'));
    }

    // 🔹 Update mesin
    public function update(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);

        $request->validate([
            'code'              => 'nullable|string|max:50|unique:machines,code,' . $id,
            'name'              => 'nullable|string|max:100',
            'brand'             => 'nullable|string|max:100',
            'type'              => 'nullable|string|max:100',
            'serial_number'     => 'nullable|string|max:100',
            'purchase_date'     => 'nullable|date',
            'installation_date' => 'nullable|date',
            'lifetime_hours'    => 'nullable|integer',
            'status'            => 'required|in:aktif,maintenance,rusak',
            'location_id'       => 'required|exists:locations,id',
        ]);

        $machine->update([
            'code'              => $request->code,
            'name'              => $request->name,
            'brand'             => $request->brand,
            'type'              => $request->type,
            'serial_number'     => $request->serial_number,
            'purchase_date'     => $request->purchase_date,
            'installation_date' => $request->installation_date,
            'lifetime_hours'    => $request->lifetime_hours,
            'status'            => $request->status,
            'location_id'       => $request->location_id,
        ]);

        return redirect()->route('machine.index')
            ->with('success', 'Machine berhasil diupdate');
    }

    // 🔹 Hapus mesin
    public function destroy($id)
    {
        $machine = Machine::findOrFail($id);
        $machine->delete();

        return redirect()->route('machine.index')
            ->with('success', 'Machine berhasil dihapus');
    }

    // 🔹 API: Detail mesin
    public function apiShow($id)
    {
        $machine = Machine::with('location')->find($id);

        if (!$machine) {
            return response()->json([
                'success' => false,
                'message' => 'Machine not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $machine
        ]);
    }
}

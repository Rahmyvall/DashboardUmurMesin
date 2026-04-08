<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\MachineUsage;

class MachineUsageController extends Controller
{
    // 🔹 List usage
    public function index()
    {
        $title = 'Data Machine Usage';

        $usages = MachineUsage::with('machine')
            ->orderBy('usage_date', 'desc')
            ->paginate(10);

        return view('admin.machine_usage.index', compact('usages', 'title'));
    }

    // 🔹 Form tambah usage
    public function create()
    {
        $title = 'Tambah Machine Usage';
        $machines = Machine::all();

        return view('admin.machine_usage.create', compact('title', 'machines'));
    }

    // 🔹 Simpan usage
    public function store(Request $request)
    {
        $request->validate([
            'machine_id'  => 'required|exists:machines,id',
            'usage_date'  => 'required|date',
            'hours_used'  => 'required|numeric',
        ]);

        // Hitung total_hours otomatis
        $lastTotal = MachineUsage::where('machine_id', $request->machine_id)
            ->latest('usage_date')
            ->value('total_hours') ?? 0;

        $total = $lastTotal + $request->hours_used;

        MachineUsage::create([
            'machine_id' => $request->machine_id,
            'usage_date' => $request->usage_date,
            'hours_used' => $request->hours_used,
            'total_hours'=> $total,
        ]);

        return redirect()->route('machine-usage.index')
            ->with('success', 'Data usage berhasil ditambahkan');
    }

    // 🔹 Detail
    public function show($id)
    {
        $title = 'Detail Machine Usage';

        $usage = MachineUsage::with('machine')->findOrFail($id);

        return view('admin.machine_usage.show', compact('usage', 'title'));
    }

    // 🔹 Edit
    public function edit($id)
    {
        $title = 'Edit Machine Usage';

        $usage = MachineUsage::findOrFail($id);
        $machines = Machine::all();

        return view('admin.machine_usage.edit', compact('usage', 'title', 'machines'));
    }

    // 🔹 Update
    public function update(Request $request, $id)
    {
        $usage = MachineUsage::findOrFail($id);

        $request->validate([
            'machine_id'  => 'required|exists:machines,id',
            'usage_date'  => 'required|date',
            'hours_used'  => 'required|numeric',
        ]);

        $usage->update([
            'machine_id' => $request->machine_id,
            'usage_date' => $request->usage_date,
            'hours_used' => $request->hours_used,
        ]);

        return redirect()->route('machine-usage.index')
            ->with('success', 'Data usage berhasil diupdate');
    }

    // 🔹 Hapus
    public function destroy($id)
    {
        $usage = MachineUsage::findOrFail($id);
        $usage->delete();

        return redirect()->route('machine-usage.index')
            ->with('success', 'Data usage berhasil dihapus');
    }

    // 🔹 PRINT (Laporan)
   public function print(Request $request)
    {
        $title = 'Laporan Machine Usage';

        $query = MachineUsage::with('machine');

        if ($request->from && $request->to) {
            $query->whereBetween('usage_date', [$request->from, $request->to]);
        }

        $usages = $query->orderBy('usage_date', 'asc')->get();

        return view('admin.machine_usage.print', compact('usages', 'title'));
    }
}

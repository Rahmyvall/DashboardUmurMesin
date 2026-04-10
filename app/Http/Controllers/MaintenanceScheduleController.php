<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\Machine;
use Illuminate\Http\Request;

class MaintenanceScheduleController extends Controller
{
    /**
     * Display a listing of maintenance schedules.
     */
    public function index()
    {
        $title = 'Jadwal Maintenance Mesin';

        $schedules = MaintenanceSchedule::with('machine')->paginate(15);

        return view('admin.maintenance-schedule.index', compact('schedules', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Jadwal Maintenance';
        $machines = Machine::orderBy('name')->get();

        return view('admin.maintenance-schedule.create', compact('title', 'machines'));
    }

    /**
     * Store a newly created maintenance schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'machine_id'             => 'required|exists:machines,id',
            'interval_hours'         => 'required|integer|min:50|max:10000',
            'last_maintenance_hours' => 'required|numeric|min:0',
            'status'                 => 'nullable|in:active,inactive,completed',
            'notes'                  => 'nullable|string|max:1000',
        ]);

        $next_maintenance_hours = $validated['last_maintenance_hours'] + $validated['interval_hours'];

        MaintenanceSchedule::create([
            'machine_id'             => $validated['machine_id'],
            'interval_hours'         => $validated['interval_hours'],
            'last_maintenance_hours' => $validated['last_maintenance_hours'],
            'next_maintenance_hours' => $next_maintenance_hours,
            'status'                 => $validated['status'] ?? 'active',
            'notes'                  => $validated['notes'],
        ]);

        return redirect()->route('maintenance-schedule.index')
            ->with('success', 'Jadwal maintenance berhasil ditambahkan.');
    }

    /**
     * Display the specified maintenance schedule.
     */
    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        $title = 'Detail Jadwal Maintenance';

        $maintenanceSchedule->load('machine');

        return view('admin.maintenance-schedule.show', compact('maintenanceSchedule', 'title'));
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit(MaintenanceSchedule $maintenanceSchedule)
    {
        $title = 'Edit Jadwal Maintenance';

        $machines = Machine::orderBy('name')->get();

        return view('admin.maintenance-schedule.edit', compact('maintenanceSchedule', 'title', 'machines'));
    }

    /**
     * Update the specified maintenance schedule.
     */
    /**
 * Update the specified maintenance schedule.
 */
    public function update(Request $request, MaintenanceSchedule $maintenanceSchedule)
    {
        $validated = $request->validate([
            'machine_id'             => 'required|exists:machines,id',
            'interval_hours'         => 'required|integer|min:50|max:10000',
            'last_maintenance_hours' => 'required|numeric|min:0',
            'status'                 => 'nullable|in:active,inactive,completed',
            'notes'                  => 'nullable|string|max:1000',
        ]);

        // Hitung next_maintenance_hours
        $next_maintenance_hours = $validated['last_maintenance_hours'] + $validated['interval_hours'];

        $maintenanceSchedule->update([
            'machine_id'             => $validated['machine_id'],
            'interval_hours'         => $validated['interval_hours'],
            'last_maintenance_hours' => $validated['last_maintenance_hours'],
            'next_maintenance_hours' => $next_maintenance_hours,
            'status'                 => $validated['status'] ?? $maintenanceSchedule->status,  // ← Diperbaiki
            'notes'                  => $validated['notes'],
        ]);

        return redirect()->route('maintenance-schedule.index')
            ->with('success', 'Jadwal maintenance berhasil diperbarui.');
    }

    /**
     * Remove the specified maintenance schedule.
     */
    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->delete();

        return redirect()->route('maintenance-schedule.index')
            ->with('success', 'Jadwal maintenance berhasil dihapus.');
    }

    /**
     * Form untuk menyelesaikan maintenance
     */
    public function showCompleteForm(MaintenanceSchedule $maintenanceSchedule)
    {
        return view('admin.maintenance-schedule.complete', [
            'schedule' => $maintenanceSchedule
        ]);
    }

    /**
     * Proses menyelesaikan maintenance
     */
    public function complete(Request $request, MaintenanceSchedule $maintenanceSchedule)
    {
        $validated = $request->validate([
            'current_operating_hours' => 'required|numeric|min:' . $maintenanceSchedule->last_maintenance_hours,
            'notes'                   => 'nullable|string|max:1000',
        ]);

        $maintenanceSchedule->update([
            'last_maintenance_hours' => $validated['current_operating_hours'],
            'next_maintenance_hours' => $validated['current_operating_hours'] + $maintenanceSchedule->interval_hours,
            'notes'                  => $validated['notes'] ?? $maintenanceSchedule->notes,
            'status'                 => 'active',
        ]);

        return redirect()->route('maintenance-schedule.index')
            ->with('success', 'Maintenance berhasil diselesaikan. Jadwal maintenance berikutnya telah diperbarui.');
    }
}

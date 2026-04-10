<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceSchedule;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MaintenanceScheduleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = MaintenanceSchedule::with(['machine'])
            ->orderBy('next_maintenance_hours', 'asc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Data jadwal maintenance berhasil diambil',
            'data'    => $schedules,
            'meta'    => [
                'current_page' => $schedules->currentPage(),
                'last_page'    => $schedules->lastPage(),
                'per_page'     => $schedules->perPage(),
                'total'        => $schedules->total(),
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource.
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

        $schedule = MaintenanceSchedule::create([
            'machine_id'             => $validated['machine_id'],
            'interval_hours'         => $validated['interval_hours'],
            'last_maintenance_hours' => $validated['last_maintenance_hours'],
            'next_maintenance_hours' => $next_maintenance_hours,
            'status'                 => $validated['status'] ?? 'active',
            'notes'                  => $validated['notes'],
        ]);

        $schedule->load('machine');

        return response()->json([
            'success' => true,
            'message' => 'Jadwal maintenance berhasil dibuat',
            'data'    => $schedule
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->load('machine');

        return response()->json([
            'success' => true,
            'message' => 'Detail jadwal maintenance',
            'data'    => $maintenanceSchedule
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource.
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

        $next_maintenance_hours = $validated['last_maintenance_hours'] + $validated['interval_hours'];

        $maintenanceSchedule->update([
            'machine_id'             => $validated['machine_id'],
            'interval_hours'         => $validated['interval_hours'],
            'last_maintenance_hours' => $validated['last_maintenance_hours'],
            'next_maintenance_hours' => $next_maintenance_hours,
            'status'                 => $validated['status'] ?? $maintenanceSchedule->status,
            'notes'                  => $validated['notes'],
        ]);

        $maintenanceSchedule->load('machine');

        return response()->json([
            'success' => true,
            'message' => 'Jadwal maintenance berhasil diperbarui',
            'data'    => $maintenanceSchedule
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal maintenance berhasil dihapus'
        ], Response::HTTP_OK);
    }

    /**
     * Tandai maintenance selesai (Complete)
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

        $maintenanceSchedule->load('machine');

        return response()->json([
            'success' => true,
            'message' => 'Maintenance berhasil diselesaikan dan jadwal berikutnya diperbarui',
            'data'    => $maintenanceSchedule
        ], Response::HTTP_OK);
    }

    /**
     * API Khusus: Ambil jadwal yang mendekati atau overdue
     */
    public function upcoming()
    {
        $schedules = MaintenanceSchedule::with('machine')
            ->where('status', 'active')
            ->whereRaw('next_maintenance_hours <= last_maintenance_hours + interval_hours + 150') // dalam 150 jam lagi
            ->orderBy('next_maintenance_hours', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal maintenance yang mendekati atau overdue',
            'count'   => $schedules->count(),
            'data'    => $schedules
        ]);
    }
}
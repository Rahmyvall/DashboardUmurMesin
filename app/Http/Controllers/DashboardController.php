<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Machine;
use App\Models\MachineUsage; // 🔥 TAMBAHAN
use App\Models\Maintenance;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $menuDashboard = 'active';

        // =====================================================
        // 🔹 DATA USERS
        // =====================================================
        $totalUsers   = User::count();
        $totalAdmin   = User::where('role', 'admin')->count();
        $totalTeknisi = User::where('role', 'teknisi')->count();
        $totalManager = User::where('role', 'manager')->count();

        // =====================================================
        // 🔹 DATA LOCATIONS
        // =====================================================
        $totalLocations   = Location::count();
        $activeLocations  = Location::where('is_active', true)->count();
        $inactiveLocations = Location::where('is_active', false)->count();

        // MAP
        $locations = Location::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // =====================================================
        // 🔥 DATA MACHINES
        // =====================================================
        $totalMachines       = Machine::count();
        $activeMachines      = Machine::where('status', 'aktif')->count();
        $maintenanceMachines = Machine::where('status', 'maintenance')->count();
        $brokenMachines      = Machine::where('status', 'rusak')->count();

        // =====================================================
        // 🔥 DATA MACHINE USAGE (TAMBAHAN)
        // =====================================================
        $totalUsage = MachineUsage::count();

        $todayHours = MachineUsage::whereDate('usage_date', now())
            ->sum('hours_used');

        $totalHours = MachineUsage::sum('hours_used');

        // =====================================================
        // 🔥 DATA UNTUK GRAFIK DONUT (STATUS)
        // =====================================================
        $machineStatusChart = [
            $activeMachines,
            $maintenanceMachines,
            $brokenMachines
        ];

        // =====================================================
        // 🔥 DATA UNTUK GRAFIK BAR (PER LOKASI)
        // =====================================================
        $machinesByLocation = Machine::selectRaw('location_id, COUNT(*) as total')
            ->groupBy('location_id')
            ->with('location')
            ->get();

        $locationLabels = $machinesByLocation->pluck('location.name');
        $locationTotals = $machinesByLocation->pluck('total');

        $totalMaintenanceCost   = Maintenance::sum('cost');
        $avgMaintenanceCost     = Maintenance::avg('cost') ?? 0;
        $currentMonthCost       = Maintenance::whereMonth('maintenance_date', now()->month)
                                            ->whereYear('maintenance_date', now()->year)
                                            ->sum('cost');
        $totalMaintenanceCount  = Maintenance::count();
        return view('dashboard', compact(
            'title',
            'menuDashboard',

            // user
            'totalUsers',
            'totalAdmin',
            'totalTeknisi',
            'totalManager',

            // location
            'totalLocations',
            'activeLocations',
            'inactiveLocations',
            'locations',

            // machine
            'totalMachines',
            'activeMachines',
            'maintenanceMachines',
            'brokenMachines',

            // 🔥 machine usage (TAMBAHAN)
            'totalUsage',
            'todayHours',
            'totalHours',

            // 🔥 Maintenance Cost (WAJIB)
            'totalMaintenanceCost',
            'avgMaintenanceCost',
            'currentMonthCost',
            'totalMaintenanceCount',

            // chart
            'machineStatusChart',
            'locationLabels',
            'locationTotals'
        ));
    }
}
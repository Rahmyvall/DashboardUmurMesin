<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $menuDashboard = 'active';

        // 🔹 Data Users
        $totalUsers   = User::count();
        $totalAdmin   = User::where('role', 'admin')->count();
        $totalTeknisi = User::where('role', 'teknisi')->count();
        $totalManager = User::where('role', 'manager')->count();

        // 🔹 Data Locations
        $totalLocations = Location::count();
        $activeLocations = Location::where('is_active', true)->count();
        $inactiveLocations = Location::where('is_active', false)->count();

        // 🔹 Data untuk MAP (yang punya koordinat)
        $locations = Location::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

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
            'locations'
        ));
    }
}

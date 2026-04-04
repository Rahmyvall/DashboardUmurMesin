<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $menuDashboard = 'active';

        // 🔹 Hitung data dari tabel users
        $totalUsers   = User::count();
        $totalAdmin   = User::where('role', 'admin')->count();
        $totalTeknisi = User::where('role', 'teknisi')->count();
        $totalManager = User::where('role', 'manager')->count();

        return view('dashboard', compact(
            'title',
            'menuDashboard',
            'totalUsers',
            'totalAdmin',
            'totalTeknisi',
            'totalManager'
        ));
    }
}

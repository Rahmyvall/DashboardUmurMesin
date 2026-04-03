<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $menuDashboard = 'active';
        return view('dashboard', compact('title'));
    }
}

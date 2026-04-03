<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ✅ WAJIB tambahkan ini

class UserController extends Controller
{
    public function index()
    {
        $title = 'Data Users';
        $users = User::paginate(5);

        return view('admin.user.index', compact('title', 'users'));
    }
}
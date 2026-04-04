<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ✅ WAJIB tambahkan ini

class UserController extends Controller
{
    public function index()
    {
        $title = 'Data Users'; // Judul halaman

       $users = User::orderBy('created_at', 'desc')
             ->orderBy('id', 'asc') // memastikan urutan unik
             ->paginate(10);

        // Kirim ke view
        return view('admin.user.index', compact('users', 'title'));
    }
}
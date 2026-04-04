<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 🔹 Tampilkan semua user
    public function index()
    {
        $title = 'Data Users';

        $users = User::orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.user.index', compact('users', 'title'));
    }

    // 🔹 Form tambah user
    public function create()
    {
        $title = 'Tambah User';
        return view('admin.user.create', compact('title'));
    }

    // 🔹 Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,teknisi,manager',
        ]);

       User::create([
    'name'     => $request->name,
    'email'    => $request->email,
    'password' => Hash::make($request->password),
    'role'     => $request->role,
]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // 🔹 Detail user
    public function show($id)
    {
        $title = 'Detail User';
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user', 'title'));
    }

    // 🔹 Form edit user
    public function edit($id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user', 'title'));
    }

    // 🔹 Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'   => 'required|max:100',
            'email'  => 'required|email|unique:users,email,' . $id,
            'role'   => 'required|in:admin,teknisi,manager',
            'status' => 'required|in:active,inactive',
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'role'   => $request->role,
            'status' => $request->status,
        ];

        // 🔐 Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // ✅ HASH
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate');
    }

    // 🔹 Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }

}

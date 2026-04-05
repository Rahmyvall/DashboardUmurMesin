<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    // 🔹 Tampilkan semua lokasi
    public function index()
    {
        $title = 'Data Locations';

        $locations = Location::orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.location.index', compact('locations', 'title'));
    }

    // 🔹 Form tambah lokasi
    public function create()
    {
        $title = 'Tambah Location';
        return view('admin.location.create', compact('title'));
    }

    // 🔹 Simpan lokasi baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:100',
            'province'    => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'nullable|string|max:100',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'is_active'   => 'nullable|boolean',
        ]);

        Location::create([
            'name'        => $request->name,
            'description' => $request->description,
            'address'     => $request->address,
            'city'        => $request->city,
            'province'    => $request->province,
            'postal_code' => $request->postal_code,
            'country'     => $request->country ?? 'Indonesia',
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'is_active'   => $request->is_active ?? true,
        ]);

        return redirect()->route('location.index')
            ->with('success', 'Location berhasil ditambahkan');
    }

    // 🔹 Detail lokasi
    public function show($id)
    {
        $title = 'Detail Location';
        $location = Location::findOrFail($id);

        return view('admin.location.show', compact('location', 'title'));
    }

    // 🔹 Form edit lokasi
    public function edit($id)
    {
        $title = 'Edit Location';
        $location = Location::findOrFail($id);

        return view('admin.location.edit', compact('location', 'title'));
    }

    // 🔹 Update lokasi
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:100',
            'province'    => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'nullable|string|max:100',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'is_active'   => 'required|boolean',
        ]);

        $location->update([
            'name'        => $request->name,
            'description' => $request->description,
            'address'     => $request->address,
            'city'        => $request->city,
            'province'    => $request->province,
            'postal_code' => $request->postal_code,
            'country'     => $request->country ?? 'Indonesia',
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'is_active'   => $request->is_active,
        ]);

        return redirect()->route('location.index')
            ->with('success', 'Location berhasil diupdate');
    }

    // 🔹 Hapus lokasi
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('location.index')
            ->with('success', 'Location berhasil dihapus');
    }

    // 🔹 Map locations untuk dashboard
    public function map()
    {
        $title = 'Map Locations';

        $locations = Location::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('admin.dashboard', compact('locations', 'title'));
    }

    // 🔹 API: Detail lokasi
    public function apiShow($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $location
        ]);
    }
}

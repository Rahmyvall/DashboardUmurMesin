<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * 🔹 GET /api/locations
     */
    public function index(Request $request)
    {
        $query = Location::query();

        // Filter is_active (handle string true/false)
        if ($request->has('is_active')) {
            $query->where('is_active', filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN));
        }

        // Filter city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Search name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $locations = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List data locations',
            'data' => $locations
        ], 200);
    }

    /**
     * 🔹 POST /api/locations
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:100',
            'province'    => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'nullable|string|max:100',
            'latitude'    => 'nullable|numeric|between:-90,90',
            'longitude'   => 'nullable|numeric|between:-180,180',
            'is_active'   => 'nullable|boolean',
        ]);

        // default value
        $validated['is_active'] = $validated['is_active'] ?? true;

        $location = Location::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Location created successfully',
            'data' => $location
        ], 201);
    }

    /**
     * 🔹 GET /api/locations/{id}
     */
    public function show($id)
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
            'message' => 'Detail location',
            'data' => $location
        ], 200);
    }

    /**
     * 🔹 PUT /api/locations/{id}
     */
    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string|max:100',
            'province'    => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'nullable|string|max:100',
            'latitude'    => 'nullable|numeric|between:-90,90',
            'longitude'   => 'nullable|numeric|between:-180,180',
            'is_active'   => 'nullable|boolean',
        ]);

        $location->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Location updated successfully',
            'data' => $location
        ], 200);
    }

    /**
     * 🔹 DELETE /api/locations/{id}
     */
    public function destroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }

        $location->delete(); // support soft delete

        return response()->json([
            'success' => true,
            'message' => 'Location deleted successfully'
        ], 200);
    }
}

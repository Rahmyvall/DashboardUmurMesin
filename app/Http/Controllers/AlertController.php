<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class AlertController extends Controller
{
    /**
     * Display a listing of alerts
     */
    public function index(Request $request): View
    {
        $alerts = collect([]);   // default kosong
        $machines = collect([]);

        try {
            $query = Alert::with('machine')->latest();

            if ($request->filled('status')) {
                if ($request->status === 'unread') $query->unread();
                if ($request->status === 'unresolved') $query->unresolved();
                if ($request->status === 'resolved') $query->where('resolved', true);
            }

            $alerts = $query->paginate(15);
            $machines = Machine::select('id', 'name')->orderBy('name')->get();

        } catch (\Exception $e) {
            // Jika tabel belum ada atau error database
            session()->flash('error', 'Tabel alerts belum dibuat. Jalankan: php artisan migrate');
        }

        return view('alerts.index', compact('alerts', 'machines'));
    }

    public function create(): View
    {
        $machines = Machine::select('id', 'name')->orderBy('name')->get();
        return view('alerts.create', compact('machines'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'alert_type' => 'required|in:maintenance_due,overuse,damage,error,warning',
            'severity'   => 'required|in:low,medium,high,critical',
            'title'      => 'required|string|max:255',
            'message'    => 'required|string',
            'expires_at' => 'nullable|date|after:now',
        ]);

        Alert::create($validated);

        return redirect()->route('alerts.index')
                         ->with('success', 'Alert berhasil dibuat.');
    }

    public function show(Alert $alert): View
    {
        $alert->load('machine');
        return view('alerts.show', compact('alert'));
    }

    public function edit(Alert $alert): View
    {
        $machines = Machine::select('id', 'name')->orderBy('name')->get();
        return view('alerts.edit', compact('alert', 'machines'));
    }

    public function update(Request $request, Alert $alert): RedirectResponse
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'alert_type' => 'required|in:maintenance_due,overuse,damage,error,warning',
            'severity'   => 'required|in:low,medium,high,critical',
            'title'      => 'required|string|max:255',
            'message'    => 'required|string',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $alert->update($validated);

        return redirect()->route('alerts.show', $alert)
                         ->with('success', 'Alert berhasil diperbarui.');
    }

    public function destroy(Alert $alert): RedirectResponse
    {
        $alert->delete();
        return redirect()->route('alerts.index')
                         ->with('success', 'Alert berhasil dihapus.');
    }

    // AJAX
    public function markAsRead(Alert $alert): JsonResponse
    {
        $alert->markAsRead();
        return response()->json(['success' => true]);
    }

    public function markAsResolved(Request $request, Alert $alert): JsonResponse
    {
        $alert->markAsResolved(auth()->id());
        return response()->json(['success' => true]);
    }
}

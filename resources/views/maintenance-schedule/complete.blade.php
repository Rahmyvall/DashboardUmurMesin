@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-check-circle-fill"></i>
                            Selesaikan Maintenance
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-info">
                            <strong>Mesin:</strong>
                            {{ $schedule->machine->name ?? 'Mesin #' . $schedule->machine_id }}
                            @if ($schedule->machine->code)
                                ({{ $schedule->machine->code }})
                            @endif
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="text-center border rounded p-3">
                                    <small class="text-muted">Interval</small>
                                    <h4 class="fw-bold">{{ number_format($schedule->interval_hours) }} Jam</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center border rounded p-3">
                                    <small class="text-muted">Last Maintenance</small>
                                    <h4 class="fw-bold">{{ number_format($schedule->last_maintenance_hours, 2) }}</h4>
                                    <small class="text-muted">Jam</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center border rounded p-3 bg-light">
                                    <small class="text-muted">Next Maintenance</small>
                                    <h4 class="fw-bold text-warning">
                                        {{ number_format($schedule->next_maintenance_hours, 2) }}</h4>
                                    <small class="text-muted">Jam</small>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('maintenance-schedule.complete', $schedule->id) }}" method="POST">
                            @csrf

                            <!-- Current Operating Hours -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Total Jam Operasi Mesin Saat Ini <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="current_operating_hours"
                                    class="form-control form-control-lg @error('current_operating_hours') is-invalid @enderror"
                                    value="{{ old('current_operating_hours', $schedule->next_maintenance_hours) }}"
                                    step="0.01" min="{{ $schedule->last_maintenance_hours }}"
                                    placeholder="Masukkan total jam operasi saat ini" required>
                                @error('current_operating_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Masukkan total jam operasi mesin sekarang (harus lebih besar atau sama dengan Last
                                    Maintenance)
                                </small>
                            </div>

                            <!-- Notes -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Catatan Maintenance (Opsional)</label>
                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="5"
                                    placeholder="Contoh: Ganti oli, bersihkan filter, cek bearing, dll...">{{ old('notes', $schedule->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="bi bi-check-circle"></i>
                                    Tandai Sudah Selesai
                                </button>

                                <a href="{{ route('maintenance-schedule.show', $schedule->id) }}"
                                    class="btn btn-secondary btn-lg">
                                    Batal
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

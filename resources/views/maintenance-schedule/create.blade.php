@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h4 class="card-title mb-4 fw-bold text-primary">
                            {{ $title ?? 'Tambah Jadwal Maintenance' }}
                        </h4>

                        <form action="{{ route('maintenance-schedule.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Pilih Mesin -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Mesin <span class="text-danger">*</span></label>
                                    <select name="machine_id" class="form-control @error('machine_id') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Mesin --</option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->id }}"
                                                {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
                                                {{ $machine->name }}
                                                @if ($machine->code)
                                                    ({{ $machine->code }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('machine_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Interval Hours -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Interval Maintenance (Jam) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="interval_hours"
                                        class="form-control @error('interval_hours') is-invalid @enderror"
                                        value="{{ old('interval_hours') }}" min="50" placeholder="Contoh: 500"
                                        required>
                                    @error('interval_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Berapa jam sekali maintenance dilakukan</small>
                                </div>

                                <!-- Last Maintenance Hours -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Last Maintenance Hours (Jam Operasi) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="last_maintenance_hours"
                                        class="form-control @error('last_maintenance_hours') is-invalid @enderror"
                                        value="{{ old('last_maintenance_hours') }}" step="0.01" min="0"
                                        placeholder="Contoh: 1250.75" required>
                                    @error('last_maintenance_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Total jam operasi mesin saat maintenance terakhir</small>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                            Aktif</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Nonaktif</option>
                                    </select>
                                </div>

                                <!-- Notes -->
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">Catatan / Keterangan</label>
                                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="4"
                                        placeholder="Catatan tambahan (jenis oli, sparepart, dll)">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Jadwal
                                </button>
                                <a href="{{ route('maintenance-schedule.index') }}" class="btn btn-secondary">
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

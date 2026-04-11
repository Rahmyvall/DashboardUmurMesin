@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Buat Alert Baru</h4>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('alerts.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Mesin <span class="text-danger">*</span></label>
                                <select name="machine_id" class="form-select @error('machine_id') is-invalid @enderror"
                                    required>
                                    <option value="">Pilih Mesin...</option>
                                    @foreach ($machines as $machine)
                                        <option value="{{ $machine->id }}"
                                            {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
                                            {{ $machine->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('machine_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipe Alert <span class="text-danger">*</span></label>
                                <select name="alert_type" class="form-select @error('alert_type') is-invalid @enderror"
                                    required>
                                    <option value="maintenance_due"
                                        {{ old('alert_type') == 'maintenance_due' ? 'selected' : '' }}>Maintenance Due
                                    </option>
                                    <option value="overuse" {{ old('alert_type') == 'overuse' ? 'selected' : '' }}>Overuse
                                    </option>
                                    <option value="damage" {{ old('alert_type') == 'damage' ? 'selected' : '' }}>Damage
                                    </option>
                                    <option value="error" {{ old('alert_type') == 'error' ? 'selected' : '' }}>Error
                                    </option>
                                    <option value="warning" {{ old('alert_type') == 'warning' ? 'selected' : '' }}>Warning
                                    </option>
                                </select>
                                @error('alert_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Severity <span class="text-danger">*</span></label>
                                <select name="severity" class="form-select @error('severity') is-invalid @enderror"
                                    required>
                                    <option value="low" {{ old('severity') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('severity') == 'medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="high" {{ old('severity') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ old('severity') == 'critical' ? 'selected' : '' }}>Critical
                                    </option>
                                </select>
                                @error('severity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul Alert <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                    placeholder="Contoh: Mesin perlu maintenance" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pesan / Keterangan <span class="text-danger">*</span></label>
                                <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror"
                                    placeholder="Jelaskan detail alert..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Kadaluarsa (Opsional)</label>
                                <input type="datetime-local" name="expires_at"
                                    class="form-control @error('expires_at') is-invalid @enderror"
                                    value="{{ old('expires_at') }}">
                                @error('expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('alerts.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Alert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

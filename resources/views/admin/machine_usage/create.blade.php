@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-4">

                        <!-- Title -->
                        <h4 class="mb-4 fw-bold text-primary">
                            <i class="bi bi-clock-history"></i> {{ $title }}
                        </h4>

                        <!-- Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form -->
                        <form action="{{ route('machine-usage.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <!-- Machine -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold">Machine</label>
                                    <select name="machine_id" class="form-control rounded-3" required>
                                        <option value="">-- Pilih Machine --</option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->id }}">
                                                {{ $machine->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Usage Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Pemakaian</label>
                                    <input type="date" name="usage_date" class="form-control rounded-3"
                                        value="{{ old('usage_date') }}" required>
                                </div>

                                <!-- Hours Used -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Jam Digunakan</label>
                                    <input type="number" step="0.01" name="hours_used" class="form-control rounded-3"
                                        value="{{ old('hours_used') }}" placeholder="Contoh: 5.5" required>
                                </div>

                                <!-- Total Hours (readonly auto) -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold">Total Jam</label>
                                    <input type="text" class="form-control rounded-3" value="Auto dihitung sistem"
                                        readonly>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('machine-usage.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-success px-4">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

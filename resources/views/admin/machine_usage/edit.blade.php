@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-clock-history"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('machine-usage.index') }}" class="btn btn-dark btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <!-- Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('machine-usage.update', $usage->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <!-- Machine -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Machine</label>
                                    <select name="machine_id" class="form-control shadow-sm" required>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->id }}"
                                                {{ $usage->machine_id == $machine->id ? 'selected' : '' }}>
                                                {{ $machine->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Usage Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Pemakaian</label>
                                    <input type="date" name="usage_date" class="form-control shadow-sm"
                                        value="{{ old('usage_date', $usage->usage_date) }}" required>
                                </div>

                                <!-- Hours Used -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Jam Digunakan</label>
                                    <input type="number" step="0.01" name="hours_used" class="form-control shadow-sm"
                                        value="{{ old('hours_used', $usage->hours_used) }}" required>
                                </div>

                                <!-- Total Hours -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Total Jam</label>
                                    <input type="text" class="form-control shadow-sm"
                                        value="{{ $usage->total_hours }} jam" readonly>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('machine-usage.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update Usage
                                </button>
                            </div>

                        </form>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-muted text-end">
                        <small>
                            Dibuat:
                            {{ \Carbon\Carbon::parse($usage->created_at)->format('d M Y H:i') }}
                        </small>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

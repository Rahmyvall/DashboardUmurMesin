@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-gear"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('machine.index') }}" class="btn btn-dark btn-sm">
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

                        <form action="{{ route('machine.update', $machine->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <!-- Code -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Code</label>
                                    <input type="text" name="code" class="form-control shadow-sm"
                                        value="{{ old('code', $machine->code) }}">
                                </div>

                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Mesin</label>
                                    <input type="text" name="name" class="form-control shadow-sm"
                                        value="{{ old('name', $machine->name) }}">
                                </div>

                                <!-- Brand -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Brand</label>
                                    <input type="text" name="brand" class="form-control shadow-sm"
                                        value="{{ old('brand', $machine->brand) }}">
                                </div>

                                <!-- Type -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Type</label>
                                    <input type="text" name="type" class="form-control shadow-sm"
                                        value="{{ old('type', $machine->type) }}">
                                </div>

                                <!-- Serial Number -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Serial Number</label>
                                    <input type="text" name="serial_number" class="form-control shadow-sm"
                                        value="{{ old('serial_number', $machine->serial_number) }}">
                                </div>

                                <!-- Lifetime -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Lifetime (Jam)</label>
                                    <input type="number" name="lifetime_hours" class="form-control shadow-sm"
                                        value="{{ old('lifetime_hours', $machine->lifetime_hours) }}">
                                </div>

                                <!-- Purchase Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Pembelian</label>
                                    <input type="date" name="purchase_date" class="form-control shadow-sm"
                                        value="{{ old('purchase_date', $machine->purchase_date) }}">
                                </div>

                                <!-- Installation Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Instalasi</label>
                                    <input type="date" name="installation_date" class="form-control shadow-sm"
                                        value="{{ old('installation_date', $machine->installation_date) }}">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-control shadow-sm">
                                        <option value="aktif" {{ $machine->status == 'aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="maintenance"
                                            {{ $machine->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        <option value="rusak" {{ $machine->status == 'rusak' ? 'selected' : '' }}>Rusak
                                        </option>
                                    </select>
                                </div>

                                <!-- Location -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Lokasi</label>
                                    <select name="location_id" class="form-control shadow-sm" required>
                                        @foreach ($locations as $loc)
                                            <option value="{{ $loc->id }}"
                                                {{ $machine->location_id == $loc->id ? 'selected' : '' }}>
                                                {{ $loc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('machine.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update Machine
                                </button>
                            </div>

                        </form>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-muted text-end">
                        <small>
                            Dibuat:
                            {{ \Carbon\Carbon::parse($machine->created_at)->format('d M Y H:i') }}
                        </small>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

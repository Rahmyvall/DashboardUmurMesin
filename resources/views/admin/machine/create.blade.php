@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-4">

                        <!-- Title -->
                        <h4 class="mb-4 fw-bold text-primary">
                            <i class="bi bi-gear"></i> {{ $title }}
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
                        <form action="{{ route('machine.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <!-- Code -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Code</label>
                                    <input type="text" name="code" class="form-control rounded-3"
                                        value="{{ old('code') }}" placeholder="Contoh: MC-001">
                                </div>

                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama Mesin</label>
                                    <input type="text" name="name" class="form-control rounded-3"
                                        value="{{ old('name') }}" placeholder="Contoh: Mesin Bubut">
                                </div>

                                <!-- Brand -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Brand</label>
                                    <input type="text" name="brand" class="form-control rounded-3"
                                        value="{{ old('brand') }}" placeholder="Contoh: Toyota">
                                </div>

                                <!-- Type -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Type</label>
                                    <input type="text" name="type" class="form-control rounded-3"
                                        value="{{ old('type') }}" placeholder="Contoh: CNC">
                                </div>

                                <!-- Serial Number -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Serial Number</label>
                                    <input type="text" name="serial_number" class="form-control rounded-3"
                                        value="{{ old('serial_number') }}" placeholder="SN001">
                                </div>

                                <!-- Lifetime -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Lifetime (Jam)</label>
                                    <input type="number" name="lifetime_hours" class="form-control rounded-3"
                                        value="{{ old('lifetime_hours') }}" placeholder="10000">
                                </div>

                                <!-- Purchase Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Pembelian</label>
                                    <input type="date" name="purchase_date" class="form-control rounded-3"
                                        value="{{ old('purchase_date') }}">
                                </div>

                                <!-- Installation Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Instalasi</label>
                                    <input type="date" name="installation_date" class="form-control rounded-3"
                                        value="{{ old('installation_date') }}">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="status" class="form-control rounded-3">
                                        <option value="aktif">Aktif</option>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="rusak">Rusak</option>
                                    </select>
                                </div>

                                <!-- Location -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Lokasi</label>
                                    <select name="location_id" class="form-control rounded-3" required>
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach ($locations as $loc)
                                            <option value="{{ $loc->id }}">
                                                {{ $loc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('machine.index') }}" class="btn btn-outline-secondary">
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

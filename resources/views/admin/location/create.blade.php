@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-4">

                        <!-- Title -->
                        <h4 class="mb-4 fw-bold text-primary">
                            <i class="bi bi-geo-alt"></i> {{ $title }}
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
                        <form action="{{ route('location.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <!-- Nama Lokasi -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama Lokasi</label>
                                    <input type="text" name="name" class="form-control rounded-3"
                                        value="{{ old('name') }}" placeholder="Contoh: Kantor Cabang Bandung" required>
                                </div>

                                <!-- Kota -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kota</label>
                                    <input type="text" name="city" class="form-control rounded-3"
                                        value="{{ old('city') }}" placeholder="Contoh: Bandung">
                                </div>

                                <!-- Provinsi -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Provinsi</label>
                                    <input type="text" name="province" class="form-control rounded-3"
                                        value="{{ old('province') }}" placeholder="Contoh: Jawa Barat">
                                </div>

                                <!-- Kode Pos -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kode Pos</label>
                                    <input type="text" name="postal_code" class="form-control rounded-3"
                                        value="{{ old('postal_code') }}" placeholder="Contoh: 40115">
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold">Alamat</label>
                                    <textarea name="address" class="form-control rounded-3" rows="2" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold">Deskripsi</label>
                                    <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Deskripsi lokasi (opsional)">{{ old('description') }}</textarea>
                                </div>

                                <!-- Latitude -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Latitude</label>
                                    <input type="text" name="latitude" class="form-control rounded-3"
                                        value="{{ old('latitude') }}" placeholder="-6.200000">
                                </div>

                                <!-- Longitude -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Longitude</label>
                                    <input type="text" name="longitude" class="form-control rounded-3"
                                        value="{{ old('longitude') }}" placeholder="106.816666">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="is_active" class="form-control rounded-3">
                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('location.index') }}" class="btn btn-outline-secondary">
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

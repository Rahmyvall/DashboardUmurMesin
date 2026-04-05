@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-geo-alt"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('location.index') }}" class="btn btn-dark btn-sm">
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

                        <form action="{{ route('location.update', $location->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <!-- Nama -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Lokasi</label>
                                    <input type="text" name="name" class="form-control shadow-sm"
                                        value="{{ old('name', $location->name) }}" required>
                                </div>

                                <!-- Kota -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Kota</label>
                                    <input type="text" name="city" class="form-control shadow-sm"
                                        value="{{ old('city', $location->city) }}">
                                </div>

                                <!-- Provinsi -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Provinsi</label>
                                    <input type="text" name="province" class="form-control shadow-sm"
                                        value="{{ old('province', $location->province) }}">
                                </div>

                                <!-- Kode Pos -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Kode Pos</label>
                                    <input type="text" name="postal_code" class="form-control shadow-sm"
                                        value="{{ old('postal_code', $location->postal_code) }}">
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Alamat</label>
                                    <textarea name="address" class="form-control shadow-sm" rows="2">{{ old('address', $location->address) }}</textarea>
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Deskripsi</label>
                                    <textarea name="description" class="form-control shadow-sm" rows="3">{{ old('description', $location->description) }}</textarea>
                                </div>

                                <!-- Latitude -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Latitude</label>
                                    <input type="text" name="latitude" class="form-control shadow-sm"
                                        value="{{ old('latitude', $location->latitude) }}">
                                </div>

                                <!-- Longitude -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Longitude</label>
                                    <input type="text" name="longitude" class="form-control shadow-sm"
                                        value="{{ old('longitude', $location->longitude) }}">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="is_active" class="form-control shadow-sm">
                                        <option value="1" {{ $location->is_active ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$location->is_active ? 'selected' : '' }}>Nonaktif
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('location.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update Lokasi
                                </button>
                            </div>

                        </form>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-muted text-end">
                        <small>
                            Terakhir diupdate:
                            {{ \Carbon\Carbon::parse($location->updated_at)->format('d M Y H:i') }}
                        </small>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

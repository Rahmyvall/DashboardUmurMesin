@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-geo-alt-fill"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('location.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nama Lokasi</div>
                            <div class="col-md-8">: {{ $location->name }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Deskripsi</div>
                            <div class="col-md-8">
                                : {{ $location->description ?? '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Alamat</div>
                            <div class="col-md-8">
                                : {{ $location->address ?? '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Kota</div>
                            <div class="col-md-8">: {{ $location->city ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Provinsi</div>
                            <div class="col-md-8">: {{ $location->province ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Kode Pos</div>
                            <div class="col-md-8">: {{ $location->postal_code ?? '-' }}</div>
                        </div>

                        <!-- Koordinat -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Koordinat</div>
                            <div class="col-md-8">
                                :
                                @if ($location->latitude && $location->longitude)
                                    <span class="badge bg-info text-dark">
                                        {{ $location->latitude }}, {{ $location->longitude }}
                                    </span>
                                @else
                                    <span class="text-muted">Tidak tersedia</span>
                                @endif
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Status</div>
                            <div class="col-md-8">
                                :
                                @if ($location->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </div>
                        </div>

                        <!-- Created -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Dibuat</div>
                            <div class="col-md-8">
                                : {{ \Carbon\Carbon::parse($location->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>

                        <!-- Updated -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Diupdate</div>
                            <div class="col-md-8">
                                : {{ \Carbon\Carbon::parse($location->updated_at)->format('d M Y H:i') }}
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-end">
                        <a href="{{ route('location.edit', $location->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

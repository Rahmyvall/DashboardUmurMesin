@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">

                        <h4 class="mb-4 fw-bold text-primary">
                            <i class="bi bi-info-circle"></i> Detail Maintenance
                        </h4>

                        <div class="row g-4">

                            <div class="col-md-6">
                                <strong>Mesin</strong>
                                <p class="mb-0">{{ $maintenance->machine->name ?? 'Mesin #' . $maintenance->machine_id }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <strong>Tipe Maintenance</strong>
                                <p>
                                    @if ($maintenance->maintenance_type == 'preventive')
                                        <span class="badge bg-success">Preventive</span>
                                    @else
                                        <span class="badge bg-danger">Corrective</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6">
                                <strong>Tanggal Maintenance</strong>
                                <p>{{ $maintenance->maintenance_date->format('d F Y') }}</p>
                            </div>

                            <div class="col-md-6">
                                <strong>Teknisi</strong>
                                <p>
                                    @if ($maintenance->technician)
                                        {{ $maintenance->technician->name }}
                                    @else
                                        <span class="text-muted">Tidak ditentukan</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6">
                                <strong>Biaya</strong>
                                <p class="fw-bold">Rp {{ number_format($maintenance->cost ?? 0, 0, ',', '.') }}</p>
                            </div>

                            <div class="col-md-6">
                                <strong>Dibuat pada</strong>
                                <p>{{ $maintenance->created_at->format('d M Y H:i') }}</p>
                            </div>

                            <div class="col-12">
                                <strong>Deskripsi</strong>
                                <p class="border p-3 rounded-3 bg-light">{{ $maintenance->description ?? '-' }}</p>
                            </div>

                            <div class="col-12">
                                <strong>Catatan Tambahan</strong>
                                <p class="border p-3 rounded-3 bg-light">{{ $maintenance->notes ?? '-' }}</p>
                            </div>

                        </div>

                        <div class="mt-5">
                            <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                            </a>

                            <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit Data
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

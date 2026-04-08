@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-gear-fill"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('machine.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Code</div>
                            <div class="col-md-8">: {{ $machine->code ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nama Mesin</div>
                            <div class="col-md-8">: {{ $machine->name ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Brand</div>
                            <div class="col-md-8">: {{ $machine->brand ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Type</div>
                            <div class="col-md-8">: {{ $machine->type ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Serial Number</div>
                            <div class="col-md-8">: {{ $machine->serial_number ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Lifetime (Jam)</div>
                            <div class="col-md-8">: {{ $machine->lifetime_hours ?? 0 }} jam</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Pembelian</div>
                            <div class="col-md-8">
                                :
                                {{ $machine->purchase_date ? \Carbon\Carbon::parse($machine->purchase_date)->format('d M Y') : '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Instalasi</div>
                            <div class="col-md-8">
                                :
                                {{ $machine->installation_date ? \Carbon\Carbon::parse($machine->installation_date)->format('d M Y') : '-' }}
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Lokasi</div>
                            <div class="col-md-8">
                                : {{ $machine->location->name ?? '-' }}
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Status</div>
                            <div class="col-md-8">
                                :
                                @if ($machine->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif ($machine->status == 'maintenance')
                                    <span class="badge bg-warning text-dark">Maintenance</span>
                                @else
                                    <span class="badge bg-danger">Rusak</span>
                                @endif
                            </div>
                        </div>

                        <!-- Created -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Dibuat</div>
                            <div class="col-md-8">
                                : {{ \Carbon\Carbon::parse($machine->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-end">
                        <a href="{{ route('machine.edit', $machine->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

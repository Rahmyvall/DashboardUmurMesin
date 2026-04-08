@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-history"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('machine-usage.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <!-- Machine -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Machine</div>
                            <div class="col-md-8">
                                : {{ $usage->machine->name ?? '-' }}
                            </div>
                        </div>

                        <!-- Usage Date -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Pemakaian</div>
                            <div class="col-md-8">
                                :
                                {{ \Carbon\Carbon::parse($usage->usage_date)->format('d M Y') }}
                            </div>
                        </div>

                        <!-- Hours Used -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Jam Digunakan</div>
                            <div class="col-md-8">
                                : {{ $usage->hours_used }} jam
                            </div>
                        </div>

                        <!-- Total Hours -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Total Jam</div>
                            <div class="col-md-8">
                                : {{ $usage->total_hours }} jam
                            </div>
                        </div>

                        <!-- Created -->
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Dibuat</div>
                            <div class="col-md-8">
                                : {{ \Carbon\Carbon::parse($usage->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-end">
                        <a href="{{ route('machine-usage.edit', $usage->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

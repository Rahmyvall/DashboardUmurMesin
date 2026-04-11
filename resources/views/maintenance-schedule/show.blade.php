@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-calendar-check"></i>
                            Detail Jadwal Maintenance
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="row mb-4">
                            <!-- Informasi Mesin -->
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Mesin</h6>
                                <h4 class="fw-bold mb-0">
                                    {{ $maintenanceSchedule->machine->name ?? 'Mesin #' . $maintenanceSchedule->machine_id }}
                                </h4>
                                @if ($maintenanceSchedule->machine->code)
                                    <p class="text-muted mb-0">
                                        Kode: <strong>{{ $maintenanceSchedule->machine->code }}</strong>
                                    </p>
                                @endif
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 text-md-end">
                                <h6 class="text-muted mb-1">Status Jadwal</h6>
                                @if ($maintenanceSchedule->status == 'active')
                                    <span class="badge bg-primary fs-6 px-3 py-2">AKTIF</span>
                                @elseif($maintenanceSchedule->status == 'inactive')
                                    <span class="badge bg-secondary fs-6 px-3 py-2">NONAKTIF</span>
                                @elseif($maintenanceSchedule->status == 'completed')
                                    <span class="badge bg-success fs-6 px-3 py-2">SELESAI</span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row g-4">
                            <!-- Interval -->
                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <small class="text-muted d-block">Interval Maintenance</small>
                                    <h3 class="fw-bold text-primary mb-0">
                                        {{ number_format($maintenanceSchedule->interval_hours) }}
                                    </h3>
                                    <span class="text-muted">Jam</span>
                                </div>
                            </div>

                            <!-- Last Maintenance -->
                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <small class="text-muted d-block">Last Maintenance</small>
                                    <h3 class="fw-bold mb-0">
                                        {{ number_format($maintenanceSchedule->last_maintenance_hours, 2) }}
                                    </h3>
                                    <span class="text-muted">Jam Operasi</span>
                                </div>
                            </div>

                            <!-- Next Maintenance -->
                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center bg-light">
                                    <small class="text-muted d-block">Next Maintenance</small>
                                    <h3 class="fw-bold text-warning mb-0">
                                        {{ number_format($maintenanceSchedule->next_maintenance_hours, 2) }}
                                    </h3>
                                    <span class="text-muted">Jam Operasi</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sisa Jam -->
                        @php
                            $currentHours =
                                $maintenanceSchedule->machine->total_operating_hours ??
                                $maintenanceSchedule->last_maintenance_hours;
                            $sisaJam = $maintenanceSchedule->next_maintenance_hours - $currentHours;
                        @endphp

                        <div
                            class="mt-4 p-4 rounded text-center {{ $sisaJam <= 0 ? 'bg-danger text-white' : ($sisaJam <= 100 ? 'bg-warning' : 'bg-success text-white') }}">
                            <h5 class="mb-1">
                                @if ($sisaJam <= 0)
                                    OVERDUE MAINTENANCE
                                @else
                                    Sisa Waktu sampai Maintenance Berikutnya
                                @endif
                            </h5>
                            <h2 class="fw-bold mb-0">
                                {{ number_format(abs($sisaJam)) }} Jam
                            </h2>
                            <small>
                                @if ($sisaJam <= 0)
                                    Maintenance sudah terlambat {{ number_format(abs($sisaJam)) }} jam
                                @else
                                    Harus dilakukan dalam {{ number_format($sisaJam) }} jam operasi lagi
                                @endif
                            </small>
                        </div>

                        <!-- Catatan -->
                        @if ($maintenanceSchedule->notes)
                            <div class="mt-4">
                                <h6 class="text-muted mb-2">Catatan / Keterangan</h6>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($maintenanceSchedule->notes)) !!}
                                </div>
                            </div>
                        @endif

                        <!-- Informasi Tambahan -->
                        <div class="mt-4">
                            <div class="row">
                                <!-- Informasi Tambahan -->
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted">Dibuat pada</small>
                                            <p class="mb-0">
                                                {{ $maintenanceSchedule->created_at?->format('d M Y H:i') ?? '—' }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Terakhir diubah</small>
                                            <p class="mb-0">
                                                {{ $maintenanceSchedule->updated_at?->format('d M Y H:i') ?? 'Belum diubah' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Card Footer - Action Buttons -->
                    <div class="card-footer d-flex justify-content-between bg-light">
                        <a href="{{ route('maintenance-schedule.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>

                        <div class="d-flex gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('maintenance-schedule.edit', $maintenanceSchedule->id) }}"
                                class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit Jadwal
                            </a>

                            <!-- Tombol Selesaikan Maintenance (POST Form) -->
                            <a href="{{ route('maintenance-schedule.complete.form', $maintenanceSchedule->id) }}"
                                class="btn btn-success">
                                <i class="bi bi-check-circle-fill"></i> Selesaikan Maintenance
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('maintenance-schedule.destroy', $maintenanceSchedule->id) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus jadwal maintenance ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

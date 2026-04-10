@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm bg-body text-body">
                    <div class="card-body">

                        <!-- Judul -->
                        <h4 class="card-title mb-3 fw-bold text-primary">
                            {{ $title ?? 'Jadwal Maintenance Mesin' }}
                        </h4>

                        <!-- Action Buttons -->
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('maintenance-schedule.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah Jadwal Maintenance
                            </a>

                            <!-- Opsional: Tombol untuk maintenance yang mendesak -->
                            <a href="{{ route('maintenance-schedule.index') }}?filter=upcoming" class="btn btn-warning">
                                <i class="bi bi-exclamation-triangle"></i> Lihat yang Mendekati
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle text-body">
                                <thead class="table-secondary text-body">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Mesin</th>
                                        <th>Interval (Jam)</th>
                                        <th>Last Maintenance</th>
                                        <th>Next Maintenance</th>
                                        <th>Sisa Jam</th>
                                        <th>Status</th>
                                        <th class="no-print">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        @php
                                            $sisaJam =
                                                $schedule->next_maintenance_hours -
                                                ($schedule->machine->total_operating_hours ??
                                                    $schedule->last_maintenance_hours);
                                        @endphp

                                        <tr
                                            class="{{ $sisaJam <= 0 ? 'table-danger' : ($sisaJam <= 100 ? 'table-warning' : '') }}">
                                            <td class="text-center">
                                                {{ $schedules->firstItem() + $loop->index }}
                                            </td>

                                            <!-- Mesin -->
                                            <td>
                                                <strong>{{ $schedule->machine->name ?? 'Mesin #' . $schedule->machine_id }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $schedule->machine->code ?? '' }}</small>
                                            </td>

                                            <!-- Interval -->
                                            <td class="text-center fw-medium">
                                                {{ number_format($schedule->interval_hours) }} Jam
                                            </td>

                                            <!-- Last Maintenance -->
                                            <td class="text-center">
                                                {{ number_format($schedule->last_maintenance_hours, 2) }} Jam
                                            </td>

                                            <!-- Next Maintenance -->
                                            <td class="text-center fw-semibold">
                                                {{ number_format($schedule->next_maintenance_hours, 2) }} Jam
                                            </td>

                                            <!-- Sisa Jam -->
                                            <td class="text-center">
                                                @if ($sisaJam <= 0)
                                                    <span class="badge bg-danger">OVERDUE
                                                        ({{ number_format(abs($sisaJam)) }} Jam)</span>
                                                @else
                                                    <span class="badge bg-{{ $sisaJam <= 100 ? 'warning' : 'success' }}">
                                                        {{ number_format($sisaJam) }} Jam lagi
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Status -->
                                            <td class="text-center">
                                                @if ($schedule->status == 'active')
                                                    <span class="badge bg-primary">Aktif</span>
                                                @elseif ($schedule->status == 'inactive')
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @elseif ($schedule->status == 'completed')
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </td>

                                            <!-- Aksi -->
                                            <td class="text-center no-print">
                                                <a href="{{ route('maintenance-schedule.show', $schedule->id) }}"
                                                    class="btn btn-sm btn-info" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('maintenance-schedule.edit', $schedule->id) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <!-- Tombol Selesaikan Maintenance -->
                                                <a href="{{ route('maintenance-schedule.complete', $schedule->id) }}"
                                                    class="btn btn-sm btn-success"
                                                    onclick="return confirm('Tandai maintenance ini sebagai selesai dan buat jadwal berikutnya?')">
                                                    <i class="bi bi-check-circle"></i>
                                                </a>

                                                <form action="{{ route('maintenance-schedule.destroy', $schedule->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus jadwal maintenance ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center no-print">
                            {{ $schedules->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PRINT SCRIPT & STYLE (sama seperti sebelumnya) -->
    <script>
        function printTable() {
            var printContents = document.getElementById('printableTable').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .badge {
                border: 1px solid #000;
                color: black !important;
            }
        }
    </style>
@endsection

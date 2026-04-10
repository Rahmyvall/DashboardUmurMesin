@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm bg-body text-body">
                    <div class="card-body">

                        <!-- Judul -->
                        <h4 class="card-title mb-3 fw-bold text-primary">
                            {{ $title ?? 'Data Maintenance' }}
                        </h4>

                        <!-- Action Buttons -->
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a href="{{ route('maintenance.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah Maintenance
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle text-body">
                                <thead class="table-secondary text-body">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Mesin</th>
                                        <th>Tipe Maintenance</th>
                                        <th>Tanggal Maintenance</th>
                                        <th>Teknisi</th>
                                        <th>Biaya</th>
                                        <th>Dibuat</th>
                                        <th class="no-print">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maintenances as $maintenance)
                                        <tr>
                                            <td class="text-center">
                                                {{ $maintenances->firstItem() + $loop->index }}
                                            </td>

                                            <!-- Relasi Machine -->
                                            <td>
                                                {{ $maintenance->machine->name ?? ($maintenance->machine->code ?? 'Mesin #' . $maintenance->machine_id) }}
                                            </td>

                                            <!-- Maintenance Type -->
                                            <td class="text-center">
                                                @if ($maintenance->maintenance_type == 'preventive')
                                                    <span class="badge bg-success">Preventive</span>
                                                @else
                                                    <span class="badge bg-danger">Corrective</span>
                                                @endif
                                            </td>

                                            <!-- Tanggal Maintenance -->
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($maintenance->maintenance_date)->format('d M Y') }}
                                            </td>

                                            <!-- Teknisi -->
                                            <td>
                                                @if ($maintenance->technician)
                                                    <span class="badge bg-primary">
                                                        {{ $maintenance->technician->name }}
                                                        @if ($maintenance->technician->initials ?? false)
                                                            <small
                                                                class="ms-1 opacity-75">({{ $maintenance->technician->initials }})</small>
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">—</span>
                                                @endif
                                            </td>

                                            <!-- Biaya -->
                                            <td class="text-end fw-medium">
                                                Rp {{ number_format($maintenance->cost ?? 0, 0, ',', '.') }}
                                            </td>

                                            <!-- Created At -->
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($maintenance->created_at)->format('d M Y H:i') }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="text-center no-print">

                                                <a href="{{ route('maintenance.show', $maintenance->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('maintenance.edit', $maintenance->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('maintenance.destroy', $maintenance->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data maintenance ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
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
                        <div class="mt-3 d-flex justify-content-center no-print">
                            {{ $maintenances->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PRINT SCRIPT -->
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

    <!-- PRINT STYLE -->
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
            }

            table {
                color: black !important;
            }

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

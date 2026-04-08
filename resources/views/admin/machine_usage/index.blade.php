@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm bg-body text-body">
                    <div class="card-body">

                        <!-- Judul -->
                        <h4 class="card-title mb-3 fw-bold text-primary">
                            {{ $title }}
                        </h4>

                        <!-- Action Buttons -->
                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ route('machine-usage.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah Usage
                            </a>

                            <a href="{{ route('machine-usage.print') }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-printer"></i> Print
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle text-body">
                                <thead class="table-secondary text-body">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Machine</th>
                                        <th>Tanggal</th>
                                        <th>Jam Pakai</th>
                                        <th>Total Jam</th>
                                        <th>Dibuat</th>
                                        <th class="no-print">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usages as $usage)
                                        <tr>
                                            <td class="text-center">
                                                {{ $usages->firstItem() + $loop->index }}
                                            </td>

                                            <!-- Relasi machine -->
                                            <td>
                                                {{ $usage->machine->name ?? '-' }}
                                            </td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($usage->usage_date)->format('d M Y') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $usage->hours_used }} jam
                                            </td>

                                            <td class="text-center">
                                                {{ $usage->total_hours }} jam
                                            </td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($usage->created_at)->format('d M Y H:i') }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="text-center no-print">

                                                <a href="{{ route('machine-usage.show', $usage->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('machine-usage.edit', $usage->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('machine-usage.destroy', $usage->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                            {{ $usages->links('pagination::bootstrap-5') }}
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
        }
    </style>
@endsection

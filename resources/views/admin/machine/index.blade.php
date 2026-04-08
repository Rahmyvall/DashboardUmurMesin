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
                            <a href="{{ route('machine.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah Machine
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle text-body">
                                <thead class="table-secondary text-body">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Brand</th>
                                        <th>Tipe</th>
                                        <th>Serial Number</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Lifetime (Jam)</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($machines as $machine)
                                        <tr>
                                            <!-- Nomor -->
                                            <td class="text-center">
                                                {{ $machines->firstItem() + $loop->index }}
                                            </td>

                                            <td>{{ $machine->code }}</td>
                                            <td>{{ $machine->name }}</td>
                                            <td>{{ $machine->brand }}</td>
                                            <td>{{ $machine->type }}</td>
                                            <td>{{ $machine->serial_number ?? '-' }}</td>

                                            <!-- Relasi lokasi -->
                                            <td>
                                                {{ $machine->location->name ?? '-' }}
                                            </td>

                                            <!-- Status -->
                                            <td class="text-center">
                                                @if ($machine->status == 'aktif')
                                                    <span class="badge bg-success">Aktif</span>
                                                @elseif ($machine->status == 'maintenance')
                                                    <span class="badge bg-warning text-dark">Maintenance</span>
                                                @else
                                                    <span class="badge bg-danger">Rusak</span>
                                                @endif
                                            </td>

                                            <!-- Lifetime -->
                                            <td class="text-center">
                                                {{ $machine->lifetime_hours ?? 0 }} jam
                                            </td>

                                            <!-- Created -->
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($machine->created_at)->format('d M Y H:i') }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="text-center">

                                                <a href="{{ route('machine.show', $machine->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('machine.edit', $machine->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('machine.destroy', $machine->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus machine ini?');">
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
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $machines->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

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

            .btn,
            .pagination {
                display: none !important;
            }
        }
    </style>
@endsection

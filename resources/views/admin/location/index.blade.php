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
                            <a href="{{ route('location.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah Lokasi
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle text-body">
                                <thead class="table-secondary text-body">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>Koordinat</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $location)
                                        <tr>
                                            <!-- Nomor -->
                                            <td class="text-center">
                                                {{ $locations->firstItem() + $loop->index }}
                                            </td>

                                            <td>{{ $location->name }}</td>
                                            <td>{{ $location->address }}</td>
                                            <td>{{ $location->city }}</td>
                                            <td>{{ $location->province }}</td>

                                            <!-- Koordinat -->
                                            <td class="text-center">
                                                @if ($location->latitude && $location->longitude)
                                                    <small>
                                                        {{ $location->latitude }},
                                                        {{ $location->longitude }}
                                                    </small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <!-- Status -->
                                            <td class="text-center">
                                                @if ($location->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>

                                            <!-- Created -->
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($location->created_at)->format('d M Y H:i') }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="text-center">

                                                <a href="{{ route('location.show', $location->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('location.edit', $location->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('location.destroy', $location->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus lokasi ini?');">
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
                            {{ $locations->links('pagination::bootstrap-5') }}
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

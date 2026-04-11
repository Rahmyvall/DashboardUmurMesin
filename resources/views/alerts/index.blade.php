@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Alert</h1>
            <a href="{{ route('alerts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Alert Baru
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Total Alert: </strong> {{ $alerts->total() ?? 0 }}
                    </div>
                    <div class="col-md-6 text-end">
                        <small class="text-muted">Halaman {{ $alerts->currentPage() }} dari
                            {{ $alerts->lastPage() }}</small>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($alerts->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data alert yang tersedia.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Mesin</th>
                                    <th>Title</th>
                                    <th width="120">Severity</th>
                                    <th width="120">Status</th>
                                    <th width="150">Dibuat</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alerts as $alert)
                                    <tr>
                                        <td><strong>#{{ $alert->id }}</strong></td>
                                        <td>
                                            <strong>{{ $alert->machine->name ?? 'Mesin Tidak Ditemukan' }}</strong>
                                        </td>
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($alert->title, 65) }}
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $alert->severity_color ?? 'secondary' }} px-3 py-2">
                                                {{ ucfirst($alert->severity) }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match ($alert->status ?? 'unread') {
                                                    'unread' => 'danger',
                                                    'resolved' => 'success',
                                                    'expired' => 'warning',
                                                    default => 'info',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }}">
                                                {{ ucfirst($alert->status ?? 'unread') }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $alert->created_at->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td>
                                            <a href="{{ route('alerts.show', $alert) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('alerts.edit', $alert) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            @if (!$alerts->isEmpty())
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        {{ $alerts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

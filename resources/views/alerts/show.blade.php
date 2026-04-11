@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                <!-- Header Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">
                                    <i class="fas fa-bell me-2"></i>
                                    Detail Alert #{{ $alert->id }}
                                </h4>
                                <small class="opacity-75">
                                    {{ $alert->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <a href="{{ route('alerts.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        <!-- Status & Severity -->
                        <div class="d-flex gap-3 mb-4">
                            <div>
                                <span class="badge bg-{{ $alert->severity_color ?? 'secondary' }} fs-5 px-4 py-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ strtoupper($alert->severity) }}
                                </span>
                            </div>
                            <div>
                                <span
                                    class="badge bg-{{ $alert->status == 'unread' ? 'danger' : ($alert->status == 'resolved' ? 'success' : 'warning') }} fs-5 px-4 py-2">
                                    {{ ucfirst($alert->status ?? 'unread') }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Mesin -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <strong class="text-muted d-block mb-1">Mesin</strong>
                                <h5 class="mb-0">{{ $alert->machine->name ?? 'Mesin Tidak Ditemukan' }}</h5>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted d-block mb-1">Tipe Alert</strong>
                                <p class="mb-0 fw-medium">
                                    {{ ucwords(str_replace('_', ' ', $alert->alert_type)) }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted d-block mb-1">Dibuat Pada</strong>
                                <p class="mb-0">
                                    {{ $alert->created_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="mb-4">
                            <h4 class="fw-bold text-dark">{{ $alert->title }}</h4>
                        </div>

                        <!-- Message -->
                        <div class="mb-5">
                            <label class="text-muted fw-medium mb-2">PESAN / KETERANGAN</label>
                            <div class="alert alert-light border p-4" style="font-size: 1.05rem; line-height: 1.7;">
                                {{ $alert->message }}
                            </div>
                        </div>

                        <!-- Additional Info -->
                        @if ($alert->expires_at)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 bg-light">
                                        <strong class="text-muted">Kadaluarsa</strong>
                                        <h6 class="mb-0 mt-1">{{ $alert->expires_at->format('d F Y H:i') }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <!-- Action Buttons -->
                    <div class="card-footer bg-light d-flex flex-wrap gap-2 p-3">
                        @if (!$alert->is_read ?? true)
                            <button onclick="markAsRead({{ $alert->id }})" class="btn btn-info flex-fill">
                                <i class="fas fa-eye"></i> Mark as Read
                            </button>
                        @endif

                        @if (!($alert->resolved ?? false))
                            <button onclick="markAsResolved({{ $alert->id }})" class="btn btn-success flex-fill">
                                <i class="fas fa-check-circle"></i> Mark as Resolved
                            </button>
                        @endif

                        <a href="{{ route('alerts.edit', $alert) }}" class="btn btn-warning flex-fill">
                            <i class="fas fa-edit"></i> Edit Alert
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function markAsRead(id) {
            if (confirm('Tandai alert ini sebagai sudah dibaca?')) {
                fetch(`/alerts/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (response.ok) location.reload();
                });
            }
        }

        function markAsResolved(id) {
            if (confirm('Apakah Anda yakin ingin menandai alert ini sebagai selesai?')) {
                fetch(`/alerts/${id}/resolve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (response.ok) location.reload();
                });
            }
        }
    </script>
@endsection

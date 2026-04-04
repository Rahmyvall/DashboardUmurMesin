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
                            <a href="{{ route('user.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah User
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle text-body">
                                <thead class="table-secondary text-body">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <!-- Nomor pagination -->
                                            <td class="text-center">
                                                {{ $users->firstItem() + $loop->index }}
                                            </td>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>

                                            <!-- Role -->
                                            <td class="text-center">
                                                @if ($user->role === 'admin')
                                                    <span class="badge rounded-pill text-white"
                                                        style="background-color: #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                                        Admin
                                                    </span>
                                                @elseif ($user->role === 'manager')
                                                    <span class="badge rounded-pill text-white"
                                                        style="background-color: #3498db; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                                        Manager
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill text-white"
                                                        style="background-color: #2ecc71; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                                        Teknisi
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Created -->
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="text-center">

                                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?');">
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
                            {{ $users->links('pagination::bootstrap-5') }}
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

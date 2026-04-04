@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow-lg border-0">

                    <!-- Header -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-person-circle"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('user.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nama</div>
                            <div class="col-md-8">: {{ $user->name }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Email</div>
                            <div class="col-md-8">: {{ $user->email }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Role</div>
                            <div class="col-md-8">
                                :
                                @if ($user->role === 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @elseif($user->role === 'manager')
                                    <span class="badge bg-primary">Manager</span>
                                @else
                                    <span class="badge bg-success">Teknisi</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Status</div>
                            <div class="col-md-8">
                                :
                                @if ($user->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Dibuat</div>
                            <div class="col-md-8">
                                : {{ $user->created_at->format('d M Y H:i') }}
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-end">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

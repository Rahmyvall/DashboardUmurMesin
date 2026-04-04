@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4">

                        <!-- Title -->
                        <h4 class="mb-4 fw-bold text-primary">
                            <i class="bi bi-person-plus"></i> {{ $title }}
                        </h4>

                        <!-- Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form -->
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <!-- Nama -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama</label>
                                    <input type="text" name="name" class="form-control rounded-2"
                                        value="{{ old('name') }}" placeholder="Masukkan nama" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control rounded-2"
                                        value="{{ old('email') }}" placeholder="Masukkan email" required>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" name="password" class="form-control rounded-2"
                                        placeholder="Minimal 6 karakter" required>
                                </div>

                                <!-- Role -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Role</label>
                                    <select name="role" class="form-control rounded-2" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="teknisi">Teknisi</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-success px-4">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

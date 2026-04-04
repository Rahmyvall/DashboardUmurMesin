@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card shadow-lg border-0">

                    <!-- Header -->
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-pencil-square"></i> {{ $title }}
                        </h5>
                        <a href="{{ route('user.index') }}" class="btn btn-dark btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">

                        <!-- Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <!-- Nama -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama</label>
                                    <input type="text" name="name" class="form-control shadow-sm"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control shadow-sm"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>

                                <!-- Password -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">
                                        Password <small class="text-muted">(kosongkan jika tidak diubah)</small>
                                    </label>
                                    <input type="password" name="password" class="form-control shadow-sm">
                                </div>

                                <!-- Role -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Role</label>
                                    <select name="role" class="form-control shadow-sm" required>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="teknisi" {{ $user->role == 'teknisi' ? 'selected' : '' }}>Teknisi
                                        </option>
                                        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager
                                        </option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-control shadow-sm">
                                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update User
                                </button>
                            </div>

                        </form>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-muted text-end">
                        <small>Terakhir diupdate: {{ $user->updated_at->format('d M Y H:i') }}</small>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

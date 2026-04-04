@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card for Users Table -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{ $title }}</h4>

                        <!-- Action Buttons -->
                        <div class="mb-3 d-flex justify-content-between">
                            <a href="#" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i> Tambah User
                            </a>
                            <button class="btn btn-primary" onclick="printTable()">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>

                        <!-- Table Responsive Wrapper -->
                        <div class="table-responsive" id="printableTable">
                            <table class="table table-striped table-hover table-bordered align-middle">
                                <thead class="table-dark">
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
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">
                                                @if ($user->role === 'admin')
                                                    <span class="badge bg-danger">{{ ucfirst($user->role) }}</span>
                                                @elseif($user->role === 'manager')
                                                    <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ ucfirst($user->role) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                                            <td class="text-center">
                                                <!-- Details Button -->
                                                <a href="#" class="btn btn-sm btn-info" title="Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <!-- Edit Button -->
                                                <a href="#" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="#" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Delete">
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

    <!-- Print Script -->
    <script>
        function printTable() {
            const printContents = document.getElementById('printableTable').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // pastikan JS & style kembali normal setelah print
        }
    </script>
@endsection

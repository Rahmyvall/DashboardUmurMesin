@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-4"> {{-- ⬅️ spacing atas & bawah utama --}}

        {{-- ===================== STATS ===================== --}}
        <div class="container-fluid py-4 px-4">

            <div class="row g-4 mb-5">

                @foreach ([['title' => 'Total Users', 'value' => $totalUsers, 'icon' => 'fa-users', 'color' => 'primary'], ['title' => 'Admin', 'value' => $totalAdmin, 'icon' => 'fa-user-shield', 'color' => 'success'], ['title' => 'Manager', 'value' => $totalManager, 'icon' => 'fa-user-tie', 'color' => 'warning'], ['title' => 'Profit', 'value' => '$ 8,541', 'icon' => 'fa-money-bill-wave', 'color' => 'danger']] as $item)
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">

                            <!-- Accent Bar -->
                            <div class="stat-bar bg-{{ $item['color'] }}"></div>

                            <div class="card-body d-flex justify-content-between align-items-center">

                                <div>
                                    <p class="text-muted small mb-1">
                                        {{ $item['title'] }}
                                    </p>
                                    <h2 class="fw-bold mb-0">
                                        {{ $item['value'] }}
                                    </h2>
                                </div>

                                <div class="icon-soft bg-{{ $item['color'] }}">
                                    <i class="fa {{ $item['icon'] }}"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        {{-- ===================== CHART & MAP ===================== --}}
        <div class="row g-2 mb-5">

            <!-- ================= MAP ================= -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 dashboard-card">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center px-4 py-3"
                        style="background: linear-gradient(135deg, #4e73df, #224abe);">

                        <div class="d-flex align-items-center">
                            <div class="icon-circle me-3">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-white fw-bold">Store Locations</h6>
                                <small class="text-white-50">Monitoring lokasi mesin</small>
                            </div>
                        </div>

                        <span class="badge bg-white text-primary fw-semibold px-3 py-2 shadow-sm">
                            {{ count($locations) }} Lokasi
                        </span>
                    </div>

                    <!-- Body -->
                    <div class="position-relative">
                        <div id="map" style="height: 520px;"></div>

                        <!-- Floating Info -->
                        <div class="floating-box">
                            <i class="fa-solid fa-circle text-success me-1"></i>
                            Lokasi Aktif
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light text-muted small text-center">
                        <i class="fa-solid fa-hand-pointer me-1"></i>
                        Klik marker untuk melihat detail lokasi
                    </div>

                </div>
            </div>

            <!-- ================= MACHINE ================= -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body p-4">

                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">
                                    <i class="bi bi-gear-fill text-primary me-2"></i>
                                    Machine Activity
                                </h5>
                                <small class="text-muted">Monitoring kondisi mesin</small>
                            </div>

                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                ● Realtime
                            </span>
                        </div>

                        <!-- Total Mesin -->
                        <div class="mb-4">
                            <h1 class="fw-bold text-primary mb-0">
                                {{ $totalMachines }}
                            </h1>
                            <small class="text-muted">Total Mesin Terdaftar</small>
                        </div>

                        <!-- Grafik -->
                        <div id="machine-chart" style="height: 260px;"></div>

                        <!-- Statistik -->
                        <div class="row mt-4 g-3">

                            <div class="col-4">
                                <div class="mini-card success">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Aktif</span>
                                    <h5>{{ $activeMachines }}</h5>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mini-card warning">
                                    <i class="bi bi-tools"></i>
                                    <span>Maintenance</span>
                                    <h5>{{ $maintenanceMachines }}</h5>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mini-card danger">
                                    <i class="bi bi-x-circle-fill"></i>
                                    <span>Rusak</span>
                                    <h5>{{ $brokenMachines }}</h5>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- ===================== TABLE ===================== --}}
        <div class="row">
            <div class="col-12">
                <div class="card modern-card">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Task Progress</h5>
                            <input type="text" class="form-control modern-search" placeholder="Search...">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle modern-table">
                                <thead>
                                    <tr>
                                        <th>Task</th>
                                        <th>Progress</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ([['name' => 'Air Conditioner', 'date' => 'Apr 20, 2018', 'progress' => 70], ['name' => 'Textiles', 'date' => 'May 27, 2018', 'progress' => 70], ['name' => 'Milk Powder', 'date' => 'May 18, 2018', 'progress' => 70]] as $task)
                                        <tr>
                                            <td class="fw-medium">{{ $task['name'] }}</td>

                                            <td style="width:200px">
                                                <div class="progress modern-progress">
                                                    <div class="progress-bar" style="width: {{ $task['progress'] }}%">
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-muted">{{ $task['date'] }}</td>

                                            <td>
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ $task['progress'] }}%
                                                </span>
                                            </td>

                                            <td class="text-end">
                                                <i class="fa fa-pencil text-warning me-3 action-icon"></i>
                                                <i class="fa fa-trash text-danger action-icon"></i>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

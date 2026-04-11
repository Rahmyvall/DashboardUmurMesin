@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-3 px-md-4"> {{-- spacing utama yang lebih ringkas --}}

        {{-- ===================== STATS CARDS ===================== --}}
        <div class="row g-4 mb-5">
            @foreach ([
            ['title' => 'Total Users', 'value' => $totalUsers, 'icon' => 'fa-users', 'color' => 'primary'],
            ['title' => 'Admin', 'value' => $totalAdmin, 'icon' => 'fa-user-shield', 'color' => 'success'],
            ['title' => 'Manager', 'value' => $totalManager, 'icon' => 'fa-user-tie', 'color' => 'warning'],

            ['title' => 'Total Usage', 'value' => $totalUsage, 'icon' => 'fa-clock', 'color' => 'info'],
            ['title' => 'Jam Hari Ini', 'value' => $todayHours . ' jam', 'icon' => 'fa-calendar-day', 'color' => 'success'],
            ['title' => 'Total Jam', 'value' => $totalHours . ' jam', 'icon' => 'fa-hourglass-half', 'color' => 'dark'],

            ['title' => 'Total Biaya Maintenance', 'value' => 'Rp ' . number_format($totalMaintenanceCost, 0, ',', '.'), 'icon' => 'fa-money-bill-wave', 'color' => 'danger'],
            ['title' => 'Rata-rata Biaya', 'value' => 'Rp ' . number_format($avgMaintenanceCost, 0, ',', '.'), 'icon' => 'fa-chart-bar', 'color' => 'warning'],
            ['title' => 'Biaya Bulan Ini', 'value' => 'Rp ' . number_format($currentMonthCost, 0, ',', '.'), 'icon' => 'fa-calendar-alt', 'color' => 'primary'],
            ['title' => 'Total Maintenance', 'value' => $totalMaintenanceCount . ' kali', 'icon' => 'fa-tools', 'color' => 'info'],
        ] as $item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative hover-lift">
                        <!-- Accent Bar -->
                        <div class="stat-bar bg-{{ $item['color'] }}"></div>

                        <div class="card-body d-flex justify-content-between align-items-start p-4">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium small mb-1">
                                    {{ $item['title'] }}
                                </p>
                                <h3 class="fw-bold mb-0 text-dark">
                                    {{ $item['value'] }}
                                </h3>
                            </div>

                            <div
                                class="icon-wrapper bg-{{ $item['color'] }}-subtle text-{{ $item['color'] }} rounded-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="fa {{ $item['icon'] }} fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ===================== CHART & MAP ===================== --}}
        <div class="row g-4">

            <!-- ================= MAP ================= -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 dashboard-card">
                    <!-- Header -->
                    <div class="card-header border-0 py-3 px-4 d-flex justify-content-between align-items-center"
                        style="background: linear-gradient(135deg, #4e73df, #224abe);">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon-circle bg-white text-primary me-3 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-white fw-semibold">Store Locations</h5>
                                <small class="text-white-50">Monitoring lokasi mesin secara realtime</small>
                            </div>
                        </div>

                        <span class="badge bg-white text-primary fw-semibold px-3 py-2 shadow-sm">
                            {{ count($locations) }} Lokasi
                        </span>
                    </div>

                    <!-- Body -->
                    <div class="position-relative" style="height: 520px;">
                        <div id="map" class="h-100"></div>

                        <!-- Floating Info -->
                        <div
                            class="position-absolute top-0 end-0 m-3 bg-white shadow-sm rounded-3 px-3 py-2 d-flex align-items-center">
                            <i class="fa-solid fa-circle text-success me-2"></i>
                            <small class="fw-medium">Lokasi Aktif</small>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light border-0 text-muted small py-3 text-center">
                        <i class="fa-solid fa-hand-pointer me-1"></i>
                        Klik marker untuk melihat detail lokasi
                    </div>
                </div>
            </div>

            <!-- ================= MACHINE ACTIVITY ================= -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">
                    <div class="card-body p-4">

                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">
                                    <i class="bi bi-gear-fill text-primary me-2"></i>
                                    Machine Activity
                                </h5>
                                <small class="text-muted">Monitoring kondisi mesin secara realtime</small>
                            </div>

                            <span
                                class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill d-flex align-items-center gap-1">
                                <span class="bg-success rounded-circle" style="width: 8px; height: 8px;"></span>
                                Realtime
                            </span>
                        </div>

                        <!-- Total Mesin -->
                        <div class="mb-4 pb-3 border-bottom">
                            <h1 class="fw-bold text-primary mb-0 display-5">
                                {{ $totalMachines }}
                            </h1>
                            <p class="text-muted mb-0">Total Mesin Terdaftar</p>
                        </div>

                        <!-- Chart -->
                        <div id="machine-chart" style="height: 260px;" class="mb-4"></div>

                        <!-- Status Cards -->
                        <div class="row g-3">
                            <div class="col-4">
                                <div
                                    class="mini-card bg-success-subtle text-success border-0 rounded-3 p-3 text-center hover-lift">
                                    <i class="bi bi-check-circle-fill fs-3 mb-2"></i>
                                    <div class="small fw-medium">Aktif</div>
                                    <h4 class="fw-bold mb-0">{{ $activeMachines }}</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="mini-card bg-warning-subtle text-warning border-0 rounded-3 p-3 text-center hover-lift">
                                    <i class="bi bi-tools fs-3 mb-2"></i>
                                    <div class="small fw-medium">Maintenance</div>
                                    <h4 class="fw-bold mb-0">{{ $maintenanceMachines }}</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="mini-card bg-danger-subtle text-danger border-0 rounded-3 p-3 text-center hover-lift">
                                    <i class="bi bi-x-circle-fill fs-3 mb-2"></i>
                                    <div class="small fw-medium">Rusak</div>
                                    <h4 class="fw-bold mb-0">{{ $brokenMachines }}</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Tambahkan CSS tambahan ini di layout kamu atau di section styles --}}
    <style>
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        }

        .stat-bar {
            height: 6px;
            width: 100%;
        }

        .icon-wrapper {
            width: 68px;
            height: 68px;
            font-size: 1.8rem;
        }

        .dashboard-card {
            transition: all 0.3s ease;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .mini-card {
            transition: all 0.3s ease;
        }
    </style>
@endsection

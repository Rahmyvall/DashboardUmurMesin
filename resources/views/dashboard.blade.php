@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-4"> {{-- ⬅️ spacing atas & bawah utama --}}

    {{-- ===================== STATS ===================== --}}
    <div class="row g-4 mb-5"> {{-- ⬅️ tambah jarak bawah --}}

        @foreach ([
            ['title' => 'Total Users', 'value' => $totalUsers, 'icon' => 'fa-users', 'color' => 'primary'],
            ['title' => 'Admin', 'value' => $totalAdmin, 'icon' => 'fa-user-shield', 'color' => 'success'],
            ['title' => 'Manager', 'value' => $totalManager, 'icon' => 'fa-user-tie', 'color' => 'warning'],
            ['title' => 'Profit', 'value' => '$ 8,541', 'icon' => 'fa-money', 'color' => 'danger']
        ] as $item)

        <div class="col-xl-3 col-md-6">
            <div class="card modern-card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">{{ $item['title'] }}</p>
                        <h2 class="fw-bold mb-0">{{ $item['value'] }}</h2>
                    </div>
                    <div class="icon-circle bg-{{ $item['color'] }}">
                        <i class="fa {{ $item['icon'] }}"></i>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>


    {{-- ===================== CHART & MAP ===================== --}}
    <div class="row g-4 mb-5">

        <div class="col-xl-6">
            <div class="card modern-card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Store Location</h5>
                    <div id="world-map" style="height: 420px;"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card modern-card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Sales Activity</h5>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold mb-0">720</h3>
                            <small class="text-muted">Last 6 months</small>
                        </div>
                        <span class="badge bg-success px-3 py-2">+5%</span>
                    </div>

                    <div id="smil-animations" class="mb-4"></div>

                    <div class="row text-center pt-3 border-top">
                        <div class="col-6">
                            <p class="text-muted mb-1">Positive</p>
                            <h5 class="text-success fw-bold">95%</h5>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1">Negative</p>
                            <h5 class="text-danger fw-bold">5%</h5>
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

                                @foreach ([
                                    ['name'=>'Air Conditioner','date'=>'Apr 20, 2018','progress'=>70],
                                    ['name'=>'Textiles','date'=>'May 27, 2018','progress'=>70],
                                    ['name'=>'Milk Powder','date'=>'May 18, 2018','progress'=>70]
                                ] as $task)

                                <tr>
                                    <td class="fw-medium">{{ $task['name'] }}</td>

                                    <td style="width:200px">
                                        <div class="progress modern-progress">
                                            <div class="progress-bar"
                                                style="width: {{ $task['progress'] }}%">
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

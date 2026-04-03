<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tracking Umur Mesin | {{ $title }}</title>
    <!-- Favicon icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="{{ asset('admin/image/png') }}" sizes="16x16" href="{{ asset('admin/images/logo.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>
<style>
    body {
        transition: all 0.3s ease;
    }

    /* LIGHT MODE */
    body.light-mode {
        background: #ffffff;
        color: #000;
    }

    /* DARK MODE */
    body.dark-mode {
        background: #121212;
        color: #fff;
    }

    /* navbar */
    .dark-mode .header {
        background: #1a1a1a;
    }

    /* sidebar */
    .dark-mode .sidebar {
        background: #1a1a1a;
    }

    /* dropdown */
    .dark-mode .dropdown-menu {
        background: #1e1e1e;
        color: #fff;
    }

    /* notification item */
    .dark-mode .notification-content {
        color: #fff;
    }

    /* card */
    .dark-mode .card {
        background: #1e1e1e;
    }

    /* Default (Light Mode) */
    .nav-control .hamburger .icon-menu {
        color: #000;
        /* hitam */
    }

    /* Dark Mode */
    .dark-mode .nav-control .hamburger .icon-menu {
        color: #fff;
        /* putih */
    }

    /* LIGHT MODE (default) */
    .header-left .form-control {
        background-color: #fff;
        color: #000;
        border: 1px solid #ccc;
    }

    .header-left .input-group-text {
        color: #000;
    }

    .header-left .mdi-magnify {
        color: #000;
    }

    /* DARK MODE */
    .dark-mode .header-left .form-control {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #444;
    }

    .dark-mode .header-left .form-control::placeholder {
        color: #aaa;
    }

    .dark-mode .header-left .input-group-text {
        color: #fff;
    }

    .dark-mode .header-left .mdi-magnify {
        color: #fff;
    }

    * Jarak pagination */ .pagination {
        margin-top: 15px;
    }

    /* Tengahin pagination */
    .pagination {
        justify-content: center !important;
    }

    /* Biar tombol lebih smooth */
    .page-link {
        border-radius: 6px;
        margin: 0 3px;
    }


    /* Aktif page */
    .page-item.active .page-link {
        background-color: #7571f9;
        border-color: #7571f9;
        color: #fff;
    }

    /* Hover effect */
    .page-link:hover {
        background-color: #f1f1f1;
    }
</style>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <span class="logo-compact">
            <img src="{{ asset('admin/images/logo.png') }}" alt="" style="width: 240px; height: 80px;">
        </span>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <body class="dark-mode">
                    <div class="nav-control">
                        <div class="hamburger">
                            <span class="toggle-icon"><i class="icon-menu"></i></span>
                        </div>
                    </div>
                </body>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard">
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge gradient-1 badge-pill badge-primary">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>

                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/2.jpg"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/3.jpg"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/4.jpg"
                                                    alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2 badge-primary">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>

                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" onclick="toggleTheme()">
                                <i id="theme-icon" class="fa-solid fa-moon"></i>
                            </a>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                                <span>English</span> <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('admin/images/user/1.png') }}" height="40" width="40"
                                    alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i>
                                                <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill badge-primary">3</div>
                                            </a>
                                        </li>

                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock
                                                    Screen</span></a>
                                        </li>
                                        <li><a href="/"><i class="icon-key"></i>
                                                <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow d-flex align-items-center" href="javascript:void(0);"
                            aria-expanded="false">
                            <i class="fa fa-home me-2"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li class="nav-item {{ $menuDashboard ?? '' }}">
                                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                                    <i class="fa-solid fa-chart-line me-2"></i>
                                    <span class="nav-text">Overview Mesin</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{ route('user') }}">
                                    <i class="fa fa-list"></i> Daftar Pengguna
                                </a>
                            </li>
                            <li>
                                <a href="./users-detail.html">
                                    <i class="fa fa-user"></i> Detail Pengguna
                                </a>
                            </li>
                            <li>
                                <a href="./users-create.html">
                                    <i class="fa fa-user-plus"></i> Tambah Pengguna
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-label">Sistem Mesin</li>
                    <li>
                        <a class="has-arrow d-flex align-items-center" href="javascript:void()"
                            aria-expanded="false">
                            <i class="fa-solid fa-industry me-2"></i>
                            <span class="nav-text">Manajemen Mesin</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="./lokasi-mesin.html">
                                    <i class="fa-solid fa-location-dot me-2"></i> Lokasi / Area Mesin
                                </a>
                            </li>
                            <li>
                                <a href="./mesin.html">
                                    <i class="fa-solid fa-gears me-2"></i> Master Data Mesin
                                </a>
                            </li>
                            <li>
                                <a href="./tracking-mesin.html">
                                    <i class="fa-solid fa-clock me-2"></i> Jam Operasional
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-label">Maintenance</li>
                    <li>
                        <a class="has-arrow d-flex align-items-center" href="javascript:void()"
                            aria-expanded="false">
                            <i class="fa-solid fa-screwdriver-wrench me-2"></i>
                            <span class="nav-text">Maintenance Mesin</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="./maintenance.html">
                                    <i class="fa-solid fa-tools me-2"></i> Data Maintenance
                                </a>
                            </li>
                            <li>
                                <a href="./jadwal-maintenance.html">
                                    <i class="fa-solid fa-calendar-check me-2"></i> Jadwal Preventive
                                </a>
                            </li>
                            <li>
                                <a href="./alert.html">
                                    <i class="fa-solid fa-bell me-2"></i> Alert / Notifikasi
                                </a>
                            </li>
                            <li>
                                <a href="./log-mesin.html">
                                    <i class="fa-solid fa-clipboard-list me-2"></i> Log Kondisi Mesin
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                {{ $title1 ?? ucfirst(Request::segment(1) ?? 'dashboard') }}
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>
                    Copyright &copy; {{ date('Y') }}
                    <a href="#">Tracking Umur Mesin</a>
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/js/settings.js') }}"></script>
    <script src="{{ asset('admin/js/gleek.js') }}"></script>
    <script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            @if (session('success'))
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: "Gagal!",
                    text: "{{ session('error') }}",
                    icon: "error"
                });
            @endif

        });
    </script>
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
    <script>
        const rowsPerPage = 3;
        const table = document.getElementById("myTable").getElementsByTagName("tbody")[0];
        const rows = table.getElementsByTagName("tr");

        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        let currentPage = 1;
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function displayTable(page) {
            let start = (page - 1) * rowsPerPage;
            let end = start + rowsPerPage;

            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = (i >= start && i < end) ? "" : "none";
            }

            // disable tombol kalau di ujung
            prevBtn.parentElement.classList.toggle("disabled", page === 1);
            nextBtn.parentElement.classList.toggle("disabled", page === totalPages);
        }

        // tombol previous
        prevBtn.addEventListener("click", function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                displayTable(currentPage);
            }
        });

        // tombol next
        nextBtn.addEventListener("click", function(e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                displayTable(currentPage);
            }
        });

        // init
        displayTable(currentPage);
    </script>
    <script>
        function toggleTheme() {
            const body = document.body;
            const icon = document.getElementById("theme-icon");

            body.classList.toggle("dark-mode");

            if (body.classList.contains("dark-mode")) {
                icon.classList.replace("fa-moon", "fa-sun");
                localStorage.setItem("theme", "dark");
            } else {
                icon.classList.replace("fa-sun", "fa-moon");
                localStorage.setItem("theme", "light");
            }
        }

        // load saat pertama buka
        window.onload = function() {
            const theme = localStorage.getItem("theme");
            const icon = document.getElementById("theme-icon");

            if (theme === "dark") {
                document.body.classList.add("dark-mode");
                icon.classList.replace("fa-moon", "fa-sun");
            }
        };
    </script>
    <!-- Chartjs -->
    <script src="{{ asset('admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('admin/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('admin/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('admin/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('admin/js/plugins-init/chartist.init.js') }}"></script>

    <script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
</body>

</html>

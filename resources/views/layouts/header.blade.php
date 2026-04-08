!DOCTYPE html>
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
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

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
        color: #179ace;
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
        margin-top: 10px;
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

    .table {
        color: var(--bs-body-color);
    }

    .table thead {
        background-color: var(--bs-secondary-bg);
        color: var(--bs-body-color);
    }

    .card {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
    }

    .theme-text {
        color: var(--bs-body-color) !important;
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        transition: 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    /* Card modern */
    .dashboard-card {
        transition: 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
    }

    /* Icon bulat */
    .icon-circle {
        background: rgba(255, 255, 255, 0.2);
        padding: 10px;
        border-radius: 50%;
        color: white;
    }

    /* Floating box di map */
    .floating-box {
        position: absolute;
        top: 15px;
        left: 15px;
        background: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Mini card */
    .mini-card {
        padding: 15px;
        border-radius: 12px;
        text-align: center;
        transition: 0.3s;
    }

    .mini-card i {
        font-size: 20px;
        margin-bottom: 5px;
    }

    .mini-card span {
        display: block;
        font-size: 12px;
        color: #777;
    }

    .mini-card h5 {
        margin: 5px 0 0;
        font-weight: bold;
    }

    /* Warna */
    .mini-card.success {
        background: #eafaf1;
        color: #28a745;
    }

    .mini-card.warning {
        background: #fff8e6;
        color: #ffc107;
    }

    .mini-card.danger {
        background: #fdeaea;
        color: #dc3545;
    }

    /* Hover mini */
    .mini-card:hover {
        transform: scale(1.05);
    }

    .stat-card {
        border-radius: 16px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    /* Accent bar atas */
    .stat-bar {
        height: 4px;
        width: 100%;
    }

    /* Icon soft */
    .icon-soft {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        opacity: 0.9;
    }

    /* Warna soft background */
    .bg-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .bg-success {
        background: linear-gradient(135deg, #1cc88a, #17a673);
    }

    .bg-warning {
        background: linear-gradient(135deg, #f6c23e, #dda20a);
    }

    .bg-danger {
        background: linear-gradient(135deg, #e74a3b, #c0392b);
    }

    /* Typography */
    .stat-card h2 {
        font-size: 28px;
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        #map {
            height: 300px !important;
        }
    }
</style>

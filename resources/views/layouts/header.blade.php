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
    .modern-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: 0.25s;
    }

    .modern-card:hover {
        transform: translateY(-4px);
    }

    /* Icon bulat */
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
    }

    /* Search */
    .modern-search {
        max-width: 220px;
        border-radius: 8px;
    }

    /* Table */
    .modern-table thead {
        background: #f8f9fa;
    }

    .modern-table th {
        font-weight: 600;
        color: #6c757d;
    }

    /* Progress */
    .modern-progress {
        height: 6px;
        border-radius: 10px;
    }

    /* Action icon */
    .action-icon {
        cursor: pointer;
        transition: 0.2s;
    }

    .action-icon:hover {
        transform: scale(1.2);
    }

    .card:hover {
        transform: translateY(-3px);
        transition: 0.3s;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border: 2px solid #4caf50;
        /* memberi efek border hijau untuk online */
    }

    .activity.active {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 10px;
        height: 10px;
        background: #4caf50;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .dropdown-profile {
        min-width: 200px;
        border-radius: 10px;
        padding: 10px 0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        background-color: #fff;
    }

    .dropdown-profile .dropdown-item a {
        padding: 10px 20px;
        color: #333;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .dropdown-profile .dropdown-item a:hover {
        background-color: #f0f0f0;
        border-radius: 8px;
        text-decoration: none;
    }

    .badge {
        font-size: 0.75rem;
        padding: 3px 8px;
    }

    @media (max-width: 768px) {
        #map {
            height: 300px !important;
        }
    }
</style>

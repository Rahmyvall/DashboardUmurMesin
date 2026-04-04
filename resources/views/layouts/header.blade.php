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
